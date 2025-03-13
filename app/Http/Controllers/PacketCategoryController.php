<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\PacketCategory;
use App\Models\Product;
use App\Models\StockHistories;
use Illuminate\Http\Request;

class PacketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idProduct, $idCategory)
    {
        // dd(session()->all()); // Debugging untuk melihat isi session

        $pakets = PacketCategory::where('category_product_id', $idCategory)->where('static', false)->get();
        $category = CategoryProduct::where('id', $idCategory)->first();
        $product = Product::where('id', $idProduct)->first();
        return view('order.packet.index', compact('pakets', 'category', 'product'));
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
        $validatedData = $request->validate([
            'product_id' => 'required|exists:product,id',
            'category_product_id' => 'required|exists:category_product,id',
            'name' => 'required|string|max:255',
            'stock' => 'nullable|integer',
            'price' => 'required|integer|min:0',
        ]);

        try {
            PacketCategory::create($validatedData);
            return redirect()->route('indexpaket', [
                'idProduct' => $request->product_id, // Pastikan ada dalam request
                'category_product_id' => $request->category_product_id
            ])->with(['success' => 'Paket berhasil ditambahkan!']);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, tampilkan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'nullable|integer|min:0',
            'price' => 'required|integer|min:0',
        ]);

        $paket = PacketCategory::FindOrFail($id);
        $paket->update($validatedData);
        return redirect()->back()->with(['success' => 'Paket berhasil Update!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paket = PacketCategory::FindOrFail($id);
        StockHistories::where('packet_id', $id)->delete();

        $paket->delete();
        return redirect()->back()->with(['success' => 'Paket berhasil dihapus!']);
    }
}
