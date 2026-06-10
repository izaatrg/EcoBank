<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenukaranReward extends Model
{
    use HasFactory;

    protected $table = 'penukaran_reward';

    protected $fillable = [
        'warga_id',
        'reward_id',
        'jumlah_koin',
        'status',
    ];

    public function warga(): BelongsTo
    {
        return $this->belongsTo(User::class, 'warga_id');
    }

    public function reward(): BelongsTo
    {
        return $this->belongsTo(Reward::class, 'reward_id');
    }
}
