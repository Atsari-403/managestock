<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::today();
        $attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('created_at', today())
            ->latest()
            ->first();
        return view('absenteeism.absenteeism', compact('attendance'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    private function haversineDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371000; // Radius bumi dalam meter

        $lat1 = deg2rad($lat1);
        $lng1 = deg2rad($lng1);
        $lat2 = deg2rad($lat2);
        $lng2 = deg2rad($lng2);

        $dlat = $lat2 - $lat1;
        $dlng = $lng2 - $lng1;

        $a = sin($dlat / 2) * sin($dlat / 2) +
            cos($lat1) * cos($lat2) *
            sin($dlng / 2) * sin($dlng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c; // Jarak dalam meter
    }

    private function isWithinOfficeArea($userLat, $userLng)
    {
        $offices = [
            ['lat' => env('OFFICE_LAT'), 'lng' => env('OFFICE_LNG')],
        ];
        $radius = env('OFFICE_RADIUS');

        foreach ($offices as $office) {
            if ($this->haversineDistance($userLat, $userLng, $office['lat'], $office['lng']) <= $radius) {
                return true; // Berada di dalam area salah satu cabang
            }
        }

        return false; // Berada di luar area semua cabang
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $action)
    {
        $userLat = $request->lat;
        $userLng = $request->lng;
        if (!$this->isWithinOfficeArea($userLat, $userLng)) {
            return back()->with('error', 'Anda di luar area absensi!');
        }
        // Pastikan user terautentikasi
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User tidak terautentikasi.'], 401);
        }

        // Decode data dari request JSON
        $data = json_decode($request->getContent(), true);

        // Validasi request
        $request->validate([
            'lat'  => 'required|numeric',
            'long' => 'required|numeric',
        ]);

        // Cek apakah user sudah melakukan check-in hari ini
        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('check_in', now()->toDateString())
            ->first();

        if ($action == 'checkin') {
            if ($attendance) {
                return response()->json(['error' => 'Anda sudah melakukan check-in hari ini.'], 400);
            }

            // Simpan check-in
            Attendance::create([
                'id'        => Str::uuid(),
                'user_id'   => $user->id,
                'check_in'  => now(),
                'latitude'  => $data['lat'],
                'longitude' => $data['long'],
                'status'    => 'Hadir',
            ]);

            return response()->json(['success' => 'Check-in berhasil dicatat.'], 200);
        } elseif ($action == 'checkout') {
            if (!$attendance) {
                return response()->json(['error' => 'Anda belum melakukan check-in hari ini.'], 400);
            }

            if ($attendance->check_out) {
                return response()->json(['error' => 'Anda sudah melakukan check-out hari ini.'], 400);
            }

            // Update check-out
            $attendance->update([
                'check_out' => now(),
                'latitude'  => $data['lat'],
                'longitude' => $data['long'],
            ]);

            return response()->json(['success' => 'Check-out berhasil dicatat.'], 200);
        }

        return response()->json(['error' => 'Aksi tidak valid.'], 400);
    }

    public function izin(Request $request)
    {
        dd($request);
        $user = Auth::id(); // Ambil langsung ID user
        $attendance = Attendance::where('user_id', $user)->whereDate('check_in', now()->toDateString())->first();

        if (!$attendance) {
            Attendance::create([
                'id' => Str::uuid(),
                'user_id' => $user,
                'status' => 'Izin',
                'check_in' => now(),
                'latitude' => null,
                'longitude' => null,
                // 'reason' => $request->input('reason'), // Ambil alasan dari request
            ]);

            return response()->json(['success' => true, 'message' => 'Izin berhasil diajukan.']);
        }

        return response()->json(['success' => false, 'message' => 'Anda sudah absen hari ini.'], 400);
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
