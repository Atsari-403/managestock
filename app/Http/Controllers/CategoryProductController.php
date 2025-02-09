<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idProduct)
    {
        $categoryProducts = CategoryProduct::where('product_id',$idProduct)->get(); // Menampilkan 6 produk per halaman
        $product = Product::where('id', $idProduct)->first();
        return view('order.category.index', compact('categoryProducts','product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($idProduct)
    {
        return view('order.category.create', compact('idProduct'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $idProduct)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $validatedData['product_id'] = $idProduct;
        CategoryProduct::create($validatedData);

        $categoryProducts = CategoryProduct::where('product_id',$idProduct)->get();
        $product = Product::where('id', $idProduct)->first();
        
        return redirect()->route('indexcategoryproduct',['idProduct'=>$idProduct])->with([
            'categoryProducts' => $categoryProducts,
            'product' => $product,
            'success' => 'Kategori berhasil ditambahkan!'
        ]);
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
