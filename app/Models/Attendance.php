<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Attendance extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'attendance';
    protected $primaryKey = 'id';
    public $incrementing = false; // Karena menggunakan UUID
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'check_in',
        'check_out',
        'latitude',
        'longitude',
        'status',
    ];

    /**
     * Relasi ke tabel users
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
