<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Store;
use App\Models\Transaksi;
use App\Models\User;
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

        $produkTerjualHariIni = Order::whereDate('created_at',Carbon::today())
        ->count();

        $pendapatanPerUser = User::select('users.id', 'users.name', 'users.email')
        ->leftJoin('transaksi', 'users.id', '=', 'transaksi.user_id')
        ->whereDate('transaksi.created_at', Carbon::today())
        ->groupBy('users.id', 'users.name', 'users.email')
        ->selectRaw('users.id, users.name, users.email, COALESCE(SUM(transaksi.total_stor), 0) as total_pendapatan')
        ->get();
        $pendapatanHariIni = Transaksi::whereDate('created_at', Carbon::today())
        ->sum('total_stor');
        $transaksiTerakhir = Order::with('paket')
        ->where('user_id',Auth::id())
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();


        return view('dashboard.index', compact('productTerjual', 'transaksi','pendapatanPerUser','transaksiTerakhir','produkTerjualHariIni','pendapatanHariIni'));
    }
}
