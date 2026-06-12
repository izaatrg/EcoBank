<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('tujuan');
            $table->integer('jumlah');
            $table->date('tanggal_keluar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('barang_keluar');
    }
};