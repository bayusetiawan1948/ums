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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->string('id_nota');
            $table->string('tgl');
            $table->string('kode_pelanggan');
            $table->integer('subtotal');

            $table->primary('id_nota');
            $table->foreign('kode_pelanggan')->references('id_pelanggan')->on('pelanggan')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
