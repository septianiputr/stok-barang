<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangJadiMasuk extends Model
{
    protected $table = 'barang_jadi_masuk';

    protected $fillable = [
        'brg_jadi_id',
        'jumlah',
        'keterangan',
        'created_at',
        'updated_at',
    ];

    public function barang_jadi()
    {
        return $this->belongsTo(BarangJadi::class, 'brg_jadi_id', 'id');
    }
}
