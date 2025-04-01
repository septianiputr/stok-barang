<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangSetengahJadi extends Model
{
    protected $table = 'barang_setengah_jadi';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'nama',
        'jenis',
    ];

    public function barang_masuk()
    {
        return $this->hasMany(BarangSetengahJadiMasuk::class, 'brg_setengah_jadi_id', 'id');
    }
    public function barang_keluar()
    {
        return $this->hasMany(BarangSetengahJadiKeluar::class, 'brg_setengah_jadi_id', 'id');
    }
}
