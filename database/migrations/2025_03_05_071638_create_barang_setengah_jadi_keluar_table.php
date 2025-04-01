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
        Schema::create('barang_setengah_jadi_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('brg_setengah_jadi_id', 36);
            $table->integer('jumlah');
            $table->string('keterangan', 100);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('brg_setengah_jadi_id')->references('id')->on('barang_setengah_jadi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_setengah_jadi_keluar');
    }
};
