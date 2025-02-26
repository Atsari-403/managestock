<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stores = Store::all();
        return view('store.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "address" => "required|string|max:255",
        ]);
        $store = Store::create($validated);

        $products = [
            'Pulsa',
            'E-Wallet',
            'Transaksi',
            'Prabayar',
            'Pascabayar',
            'Top Up Game',
            'Voucher',
            'Aksesoris',
            'Kartu',
            'Paket Data'
        ];

        // dd($request);
        // Masukkan produk saat store dibuat
        foreach ($products as $product) {
            Product::create([
                'id' => Str::uuid(),
                'store_id' => $store->id,
                'name' => $product,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // return redirect()->back()->with(['success' => 'Stock berhasil Ditambah!']);
        return redirect()->back()->with('success', 'Store berhasil dibuat!');
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
        $store = Store::findOrFail($id);
        $store->delete();

        return redirect()->back()->with('success', 'Store berhasil dihapus!');
    }
}
