<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AttendanceExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = Attendance::query()->with('user');

        if (!empty($this->filters['user_id'])) {
            $query->where('user_id', $this->filters['user_id']);
        }

        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        if (!empty($this->filters['date_from'])) {
            $query->whereDate('created_at', $this->filters['date_from']);
        }

        return $query;
    }

    public function headings(): array
    {
        return ["Tanggal", "Nama", "Status", "Jam Masuk", "Jam Pulang"];
    }

    public function map($attendance): array
    {
        return [
            $attendance->created_at->format('d/m/Y'), // Format tanggal
            $attendance->user->name, // Nama user
            ucfirst($attendance->status), // Status (Hadir/Izin)
            $attendance->check_in ?? '-', // Jam masuk
            $attendance->check_out ?? '-', // Jam pulang
        ];
    }
}
