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
        Schema::create('pemesanan_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesanan_id');
            $table->string('barang_jadi_id', 36);
            $table->integer('jumlah');
            $table->integer('jumlah_jadi');
            $table->timestamps();

            $table->foreign('pemesanan_id')->references('id')->on('pemesanan')->onDelete('cascade');
            $table->foreign('barang_jadi_id')->references('id')->on('barang_jadi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_detail');
    }
};
