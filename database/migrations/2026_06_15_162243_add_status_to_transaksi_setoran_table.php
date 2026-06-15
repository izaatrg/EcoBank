<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transaksi_setoran', function (Blueprint $table) {
            // Menambahkan kolom status dengan nilai default 'proses'
            // Kita letakkan setelah kolom 'total_koin' agar rapi di database
            $table->string('status')->default('proses')->after('total_koin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_setoran', function (Blueprint $table) {
            // Menghapus kolom status jika kita melakukan rollback migrasi
            $table->dropColumn('status');
        });
    }
};