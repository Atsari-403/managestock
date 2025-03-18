<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Order;
use App\Models\PacketCategory;
use App\Models\Product;
use App\Models\StockHistories;
use App\Models\Store;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function indexStore()
    {
        $stores = Store::all();
        return view('order.store', compact('stores'));
    }
    public function indexProduct()
    {
        $store_id = Auth::user()->store_id;
        $products = Product::where('store_id', $store_id)->get(); // Menampilkan 6 produk per halaman
        return view('order.index', compact('products'));
    }
    public function indexProductAdmin($store_id)
    {
        $products = Product::where('store_id', $store_id)->get();
        return view('order.index', compact('products'));
    }

    public function indexCategory($idProduct)
    {
        $categoryProducts = CategoryProduct::where('product_id', $idProduct)->get(); // Menampilkan 6 produk per halaman
        $product = Product::where('id', $idProduct)->first();
        return view('order.category', compact('categoryProducts', 'product'));
    }

    public function indexPacket($idProduct, $idCategory)
    {
        $pakets = PacketCategory::where('category_product_id', $idCategory)->where('static', false)->get();
        $category = CategoryProduct::where('id', $idCategory)->first();
        $product = product::where('id', $idProduct)->first();
        return view('order.packet', compact('pakets', 'category', 'product'));
    }

    public function indexOrder(Request $request)
    {
        $userId = $request->input('user_id');
        $paketId = $request->input('paket_id');
        $date = $request->input('date');

        // Query untuk mendapatkan data order dengan filter
        $orders = Order::with(['user', 'paket'])
            ->when($userId, function ($query, $userId) {
                return $query->where('user_id', $userId);
            })
            ->when($paketId, function ($query, $paketId) {
                return $query->where('paket_id', $paketId);
            })
            ->when($date, function ($query, $date) {
                return $query->whereDate('created_at', $date);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5); // Batasi 10 order per halaman

        // Ambil data user & paket untuk dropdown filter
        $users = User::all();
        $pakets = PacketCategory::all();

        return view('report.order', compact('orders', 'users', 'pakets'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->back()->withErrors(['error' => 'Anda harus login untuk melakukan pembelian.']);
        }
        $request->validate([
            'paket_id' => 'nullable|exists:paket_category,id',
            'paket_name' => 'nullable|string|max:255',
            'qty' => 'nullable|integer|min:1',
            'payment_method' => 'nullable|boolean',
            'action' => 'nullable|boolean',
            'price' => 'required|numeric|min:0',
            'margin' => 'nullable|numeric|min:0',
            'category_product_id' => 'required|exists:category_product,id',
        ]);

        if (!$request->paket_id) {
            // Jika paket belum ada, buat baru
            $paket = PacketCategory::create([
                'category_product_id' => $request->category_product_id,
                'name' => $request->paket_name,
                'stock' => null,
                'price' => $request->price,
                'margin' => $request->margin,
                'static' => true,
            ]);


            $price = $paket->price;
            // dd($price);
        } else {
            // Jika paket sudah ada, ambil dari database
            $paket = PacketCategory::findOrFail($request->paket_id);
            $price = $paket->price;

            // Cek apakah stok cukup sebelum dikurangi
            if ($paket->stock < $request->qty) {
                return redirect()->back()->withErrors(['error' => 'Stok tidak mencukupi!']);
            }


            if ($paket->stock != null) {

                $previousStock = $paket->stock;
                $paket->stock -= $request->qty;
                $paket->save();

                // Catat riwayat perubahan stok
                StockHistories::create([
                    'packet_id' => $paket->id,
                    'previous_stock' =>  $previousStock,
                    'new_stock' => $paket->stock,
                    'quantity_changed' => -$request->qty,
                ]);
            }
            // Simpan perubahan stok

        }

        if ($request->qty != null) {
            $total_harga = $request->qty * $price + $paket->margin;
        } else {
            $total_harga = $price + $paket->margin;
        }
        // dd($price);
        // Simpan order
        $transaksi = Transaksi::where('user_id', Auth::id())
            ->whereDate('created_at', Carbon::today())
            ->first();

        //tarik tunai
        if ($request->action == 1 && $request->payment_method == 0) {
            $transaksi->update([
                'total_cash' => $transaksi->total_cash - $request->price,
                'total_digital' => $transaksi->total_digital + $total_harga,
            ]);
        } else if ($request->action == 0 && $request->payment_method == 1) {
            $transaksi->update([
                'total_cash' => $transaksi->total_cash + $total_harga,
            ]);
        } else if ($request->action == null && $request->payment_method == 1) {
            $transaksi->update([
                'total_cash' => $transaksi->total_cash + $total_harga,
            ]);
        } else if ($request->action == null && $request->payment_method == 0) {
            $transaksi->update([
                'total_digital' => $transaksi->total_digital + $total_harga,
            ]);
        }
        $transaksi->update([
            'total_stor' => $transaksi->total_cash - 250000,
        ]);
        Order::create([
            'user_id' => Auth::id(),
            'paket_id' => $paket->id,
            'qty' => $request->qty,
            'total_harga' => $total_harga,
            'payment_method' => $request->payment_method,
            'action' => $request->action, // Default "Menunggu" jika null
        ]);

        return redirect()->back()->with('success', 'Order berhasil dibuat!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
