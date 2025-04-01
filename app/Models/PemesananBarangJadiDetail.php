<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemesananBarangJadiDetail extends Model
{
    protected $table = 'pemesanan_detail';
    protected $fillable = ['pemesanan_id', 'barang_jadi_id', 'jumlah', 'jumlah_jadi', 'created_at', 'updated_at'];

    public function pemesanan()
    {
        return $this->belongsTo(PemesananBarangJadi::class, 'pemesanan_id', 'id');
    }

    public function barang_jadi()
    {
        return $this->belongsTo(BarangJadi::class, 'barang_jadi_id', 'id');
    }
}
