<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'product';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'store_id',
        'name',
    ];

    public function categories(): HasMany
    {
        return $this->hasMany(CategoryProduct::class, 'product_id');
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }
}
