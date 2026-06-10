<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaldoKoin extends Model
{
    use HasFactory;

    protected $table = 'saldo_koin';

    protected $fillable = [
        'warga_id',
        'total_koin',
    ];

    public function warga(): BelongsTo
    {
        return $this->belongsTo(User::class, 'warga_id');
    }
}
