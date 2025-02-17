<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        // **Transaksi Biasa (Tanpa Tarik Tunai / Top-up)**
        $totalCashIn = Order::where('payment_method', 1)
            ->sum('total_harga');

        $totalDigitalIn = Order::where('payment_method', 0)
            ->sum('total_harga');


      

        // **Hitung Saldo Akhir**
        $netCash = $totalCashIn ;
        $netDigital = $totalDigitalIn;
        $totalPendapatanBersih = $netCash + $netDigital;


        $productTerjual = Order::count();

        return view('dashboard.index', compact('productTerjual', 'netCash', 'netDigital', 'totalPendapatanBersih'));
    }
}
