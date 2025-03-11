<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'orders';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'user_id',
        'paket_id',
        'qty',
        'total_harga',
        'payment_method',
        'action',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function paket()
    {
        return $this->belongsTo(PacketCategory::class, 'paket_id', 'id');
    }
}
