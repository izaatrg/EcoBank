<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penukaran_reward', function (Blueprint $table) {

            $table->id();

            $table->foreignId('warga_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('reward_id')
                  ->constrained('reward')
                  ->onDelete('cascade');

            $table->integer('jumlah_koin');

            $table->enum('status', [
                'menunggu',
                'disetujui',
                'diambil'
            ])->default('menunggu');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penukaran_reward');
    }
};