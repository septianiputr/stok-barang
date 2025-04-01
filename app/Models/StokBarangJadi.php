<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokBarangJadi extends Model
{
    protected $table = 'stok_barang_jadi';

    protected $fillable = [
        'tanggal',
        'brg_jadi_id',
        'stok_awal',
        'jumlah_masuk',
        'jumlah_keluar',
        'created_at',
        'updated_at',
    ];

    public function barang_jadi()
    {
        return $this->belongsTo(BarangJadi::class, 'brg_jadi_id', 'id');
    }
}
