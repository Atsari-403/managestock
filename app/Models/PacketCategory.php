<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'profit_margin',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryProduct::class, 'category_product_id');
    }
}
