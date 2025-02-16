<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockHistories extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'stock_histories'; // Pastikan sesuai dengan nama tabel yang digunakan

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'packet_id',
        'previous_stock',
        'new_stock',
        'quantity_changed',
    ];

    public function packet():BelongsTo 
    {
        return $this->belongsTo(PacketCategory::class,'packet_id');
    }
}
