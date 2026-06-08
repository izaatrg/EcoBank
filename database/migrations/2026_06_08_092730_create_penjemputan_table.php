<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penjemputan', function (Blueprint $table) {

            $table->id();

            $table->foreignId('warga_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('petugas_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->date('tanggal_jemput');

            $table->time('jam_jemput');

            $table->text('catatan')->nullable();

            $table->enum('status', [
                'menunggu',
                'diproses',
                'selesai'
            ])->default('menunggu');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penjemputan');
    }
};