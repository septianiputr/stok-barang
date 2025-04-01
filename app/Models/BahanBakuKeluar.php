<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanBakuKeluar extends Model
{
    protected $table = 'bahan_baku_keluar';
    protected $fillable = ['bahan_baku_id', 'jumlah', 'keterangan', 'created_at', 'updated_at'];

    public function bahan_baku()
    {
        return $this->belongsTo(BahanBaku::class, 'bahan_baku_id');
    }
}
