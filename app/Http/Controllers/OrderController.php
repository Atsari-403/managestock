<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\PacketCategory;
use App\Models\Product;
use Illuminate\Http\Request;

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

    public function indexCategory($idProduct){
        $categoryProducts = CategoryProduct::where('product_id',$idProduct)->get(); // Menampilkan 6 produk per halaman
        $product = Product::where('id', $idProduct)->first();
        return view('order.category', compact('categoryProducts','product'));
    }

    public function indexPacket($idProduct,$idCategory){
        $pakets = PacketCategory::where('category_product_id', $idCategory)->get();
        $category = CategoryProduct::where('id', $idCategory)->first();
        $product = product::where('id', $idProduct)->first();
        return view('order.packet', compact('pakets', 'category','product'));
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
        //
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
