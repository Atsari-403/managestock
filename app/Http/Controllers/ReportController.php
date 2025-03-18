<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Order;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function attendance(Request $request)
    {
        // Ambil daftar pengguna untuk filter dropdown
        $users = User::select('id', 'name')->get();

        // Ambil filter dari request
        $userId = $request->input('user_id');
        $status = $request->input('status');
        $dateFrom = $request->input('date_from');

        // Query data absensi
        $attendances = Attendance::with('user')
            ->when($userId, function ($query, $userId) {
                return $query->where('user_id', $userId);
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($dateFrom, function ($query, $dateFrom) {
                return $query->whereDate('created_at', '=', $dateFrom);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('reports.attendance', compact('attendances', 'users'));
    }

    public function income(Request $request)
    {
        $userId = $request->input('user_id');
        $dateFrom = $request->input('date_from');
        $transactions = Transaksi::with('user')
            ->when($userId, function ($query, $userId) {
                return $query->where('user_id', $userId);
            })
            ->when($dateFrom, function ($query, $dateFrom) {
                return $query->whereDate('created_at', $dateFrom);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(3);
    

        $users = User::all(); // Ambil daftar user untuk dropdown filter

        return view('reports.income', compact('users','transactions'));
    }
}
