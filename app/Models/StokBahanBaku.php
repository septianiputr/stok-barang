<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBahanBaku extends Model
{
    use HasFactory;

    protected $table = 'stok_bahan_baku';
    protected $fillable = ['tanggal', 'bahan_baku_id', 'stok_awal', 'jumlah_masuk', 'jumlah_keluar'];

    public function bahan_baku()
    {
        return $this->belongsTo(BahanBaku::class, 'bahan_baku_id', 'id');
    }
}
