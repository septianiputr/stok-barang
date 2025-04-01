<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangSetengahJadiKeluar extends Model
{
    protected $table = 'barang_setengah_jadi_keluar';

    protected $fillable = [
        'brg_setengah_jadi_id',
        'jumlah',
        'keterangan',
        'created_at',
        'updated_at',
    ];

    public function brg_setengah_jadi()
    {
        return $this->belongsTo(BarangSetengahJadi::class, 'brg_setengah_jadi_id', 'id');
    }
}
