<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema; 

return new class extends Migration
{
    /**
     * Jalankan perintah untuk membuat tabel barang_masuk.
     */
    public function up(): void
    {
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique(); // Format #IN-0001
            $table->string('nama_barang');
            $table->string('kategori');
            $table->string('satuan');
            $table->decimal('jumlah', 10, 2);
            $table->date('tanggal_masuk');
            $table->timestamps();
        });
    }

    /**
     * Membatalkan migrasi tabel jika diperlukan.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk');
    }
};
