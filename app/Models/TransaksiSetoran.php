<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiSetoran extends Model
{
    use HasFactory;

    protected $table = 'transaksi_setoran';

    protected $fillable = [
        'warga_id',
        'petugas_id',
        'kategori_id',
        'berat',
        'total_koin',
        'tanggal_setor',
    ];

    public function warga(): BelongsTo
    {
        return $this->belongsTo(User::class, 'warga_id');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriSampah::class, 'kategori_id');
    }
}
