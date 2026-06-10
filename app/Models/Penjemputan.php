<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penjemputan extends Model
{
    use HasFactory;

    protected $table = 'penjemputan';

    protected $fillable = [
        'warga_id',
        'petugas_id',
        'tanggal_jemput',
        'jam_jemput',
        'catatan',
        'status',
    ];

    public function warga(): BelongsTo
    {
        return $this->belongsTo(User::class, 'warga_id');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
