<?php

namespace App\Http\Controllers;

use App\Models\PacketCategory;
use App\Models\StockHistories;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $packets = PacketCategory::whereNotNull('stock')->get();

        $query = StockHistories::with('packet');
        if ($request->has('packet_id') && !empty($request->packet_id)) {
            $query->where('packet_id', $request->packet_id);
        }
        $stockHistories = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('report.stock', compact('stockHistories', 'packets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function addStock(Request $request, $id)
    {
        $request->validate([
            'packet_id' => 'required|exists:paket_category,id',
            'quantity_changed' => 'required|integer|min:1',
        ]);

        $packet = PacketCategory::find($id);
        if (!$packet) {
            return redirect()->back()->withErrors(['error' => 'Paket tidak ditemukan!']);
        }
        $previousStock = $packet->stock;
        $packet->stock += $request->quantity_changed;
        $packet->save();

        StockHistories::create([
            'packet_id' => $packet->id,
            'previous_stock' =>  $previousStock,
            'new_stock' => $packet->stock,
            'quantity_changed' => $request->quantity_changed,
        ]);
        return redirect()->back()->with(['success' => 'Stock berhasil Ditambah!']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

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
