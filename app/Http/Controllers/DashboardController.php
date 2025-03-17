<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Store;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        
        $transaksi = Transaksi::where('user_id', Auth::id())
        ->whereDate('created_at', Carbon::today())
        ->first();


        $productTerjual = Order::where('user_id',Auth::id())
        ->whereDate('created_at',Carbon::today())
        ->count();

        return view('dashboard.index', compact('productTerjual', 'transaksi'));
    }
}
