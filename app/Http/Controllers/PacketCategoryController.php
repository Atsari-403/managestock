<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\PacketCategory;
use Illuminate\Http\Request;

class PacketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idCategory)
    {
        // dd(session()->all()); // Debugging untuk melihat isi session

        $pakets = PacketCategory::where('category_product_id', $idCategory)->get();
        $category = CategoryProduct::where('id', $idCategory)->first();
        return view('order.packet.index', compact('pakets', 'category'));
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
            'category_product_id' => 'required|exists:category_product,id',
            'name' => 'required|string|max:255',
            'stock' => 'nullable|integer|min:0',
            'price' => 'required|integer|min:0',
            'profit_margin' => 'required|integer|min:0',
        ]);

        try {
            PacketCategory::create($validatedData);
            return redirect()->route('indexpaket',$request->category_product_id)->with(['success' => 'Paket berhasil ditambahkan!']);
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
