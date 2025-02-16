<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PacketCategory extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'paket_category';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'category_product_id',
        'name',
        'stock',
        'price',
        'static',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryProduct::class, 'category_product_id');
    }

    public function order(): HasMany
    {
        return $this->hasMany(Order::class, 'paket_id', 'id');
    }
    public function stockHistories(): HasMany
    {
        return $this->hasMany(StockHistories::class, 'paket_id');
    }
}
