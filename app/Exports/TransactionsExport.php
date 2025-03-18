<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = Transaksi::query()->with('user');

        if (!empty($this->filters['user_id'])) {
            $query->where('user_id', $this->filters['user_id']);
        }

        if (!empty($this->filters['date_from'])) {
            $query->whereDate('created_at', $this->filters['date_from']);
        }

        return $query;
    }

    public function headings(): array
    {
        return ["Nama Staff", "Tanggal", "Setoran"];
    }

    public function map($transaction): array
    {
        return [
            $transaction->user->name, // Nama Staff
            $transaction->created_at->format('d/m/Y'), // Tanggal dalam format yang lebih rapi
            'Rp ' . number_format($transaction->total_stor ?? 0, 0, ',', '.'),
        ];
    }
}
