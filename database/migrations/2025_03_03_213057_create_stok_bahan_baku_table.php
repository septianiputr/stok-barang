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
        Schema::create('stok_bahan_baku', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal', 36);
            $table->string('bahan_baku_id', 36);
            $table->integer('stok_awal');
            $table->integer('jumlah_masuk', 0);
            $table->integer('jumlah_keluar', 0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('bahan_baku_id')->references('id')->on('bahan_baku')->onDelete('cascade');
            $table->unique(['tanggal', 'bahan_baku_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_bahan_baku');
    }
};
