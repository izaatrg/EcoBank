<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'no_hp',
        'alamat',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function saldoKoin(): HasOne
    {
        return $this->hasOne(SaldoKoin::class, 'warga_id');
    }

    public function transaksiSetoran(): HasMany
    {
        return $this->hasMany(TransaksiSetoran::class, 'warga_id');
    }

    public function setoranSebagaiPetugas(): HasMany
    {
        return $this->hasMany(TransaksiSetoran::class, 'petugas_id');
    }

    public function penjemputan(): HasMany
    {
        return $this->hasMany(Penjemputan::class, 'warga_id');
    }

    public function penukaranReward(): HasMany
    {
        return $this->hasMany(PenukaranReward::class, 'warga_id');
    }
}
