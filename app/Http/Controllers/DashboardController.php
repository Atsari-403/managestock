<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $totalCashIn = Order::where('payment_method', 1)->where('user_id',Auth::id())
            ->where(function ($query) {
                $query->whereNull('action')
                    ->orWhere('action', 0);
            })
            ->sum('total_harga');

        $totalDigitalIn = Order::where('payment_method', 0)->where('user_id',Auth::id())
            ->where(function ($query) {
                $query->whereNull('action')
                    ->orWhere('action', 1);
            })
            ->sum('total_harga');


        $totalCashOut = Order::where('payment_method', 0)->where('user_id',Auth::id())
            ->where('action', 1)
            ->sum('total_harga');


        $netCash = $totalCashIn - $totalCashOut;
        $netDigital = $totalDigitalIn ;
        $totalPendapatanBersih = $netCash + $netDigital;


        $productTerjual = Order::where('user_id',Auth::id())->count();

        return view('dashboard.index', compact('productTerjual', 'netCash', 'netDigital', 'totalPendapatanBersih'));
    }
}
