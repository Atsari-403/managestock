<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    use HasFactory, HasUlids;
    protected $table = 'stores';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'address',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'store_id', 'id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'store_id', 'id');
    }
}
