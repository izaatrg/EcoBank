<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_setoran', function (Blueprint $table) {

            $table->id();

            $table->foreignId('warga_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('petugas_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('kategori_id')
                  ->constrained('kategori_sampah')
                  ->onDelete('cascade');

            $table->decimal('berat', 8, 2);

            $table->integer('total_koin');

            $table->date('tanggal_setor');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_setoran');
    }
};