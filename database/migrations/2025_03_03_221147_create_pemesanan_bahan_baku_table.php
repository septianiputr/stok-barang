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
        Schema::create('pemesanan_bahan_baku', function (Blueprint $table) {
            $table->id();
            $table->string('bahan_baku_id', 36);
            $table->integer('jumlah');
            $table->string('keterangan', 100);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('bahan_baku_id')->references('id')->on('bahan_baku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_bahan_baku');
    }
};
