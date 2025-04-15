<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'store_id',
        'name',
        'email',
        'password',
        'phone_number',
        'role',
        'picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    protected static function boot()
    {
        parent::boot();

        // Automatically generate UUID for the model
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class, 'user_id', 'id');
    }
    public function hasAttendedToday(): bool
    {
        return $this->attendance()
            ->where('status', 'Hadir')->whereDate('check_in', Carbon::today())
            ->exists();
    }

    public function hasCheckedOutToday(): bool
    {
        return $this->attendance()
            ->whereDate('created_at', Carbon::today())
            ->whereNotNull('check_out')
            ->exists();
    }
    public function status(): bool
    {
        return $this->attendance()
            ->where('status', 'Izin')
            ->whereDate('check_in', Carbon::today())
            ->exists();
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'user_id', 'id');
    }
}
