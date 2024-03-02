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
        Schema::create('item_penjualan', function (Blueprint $table) {
            $table->string('id_nota');
            $table->string('kode_barang');
            $table->integer('qty');

            $table->foreign('id_nota')->references('id_nota')->on('penjualan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('kode_barang')->references('kode')->on('barang')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_penjualan');
    }
};
