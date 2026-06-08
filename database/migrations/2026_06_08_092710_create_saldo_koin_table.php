<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saldo_koin', function (Blueprint $table) {

            $table->id();

            $table->foreignId('warga_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->integer('total_koin')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saldo_koin');
    }
};