<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Order;
use App\Models\PacketCategory;
use App\Models\Product;
use App\Models\StockHistories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all(); // Menampilkan 6 produk per halaman
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

    public function indexOrder()
    {
        return view('report.order');
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
            'category_product_id' => 'required|exists:category_product,id',
        ]);

        if (!$request->paket_id) {
            // Jika paket belum ada, buat baru
            $paket = PacketCategory::create([
                'category_product_id' => $request->category_product_id,
                'name' => $request->paket_name,
                'stock' => null,
                'price' => $request->price,
                'static' => true,
            ]);
            

            $price = $request->price;
        } else {
            // Jika paket sudah ada, ambil dari database
            $paket = PacketCategory::findOrFail($request->paket_id);
            $price = $paket->price;

            // Cek apakah stok cukup sebelum dikurangi
            if ($paket->stock < $request->qty) {
                return redirect()->back()->withErrors(['error' => 'Stok tidak mencukupi!']);
            }


            if($paket->stock != null){

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

        // Simpan order
        Order::create([
            'user_id' => Auth::id(),
            'paket_id' => $paket->id,
            'qty' => $request->qty,
            'total_harga' => $request->qty * $price,
            'payment_method' => $request->payment_method,
            'action' => $request->action ?? 0, // Default "Menunggu" jika null
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
