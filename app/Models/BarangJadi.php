<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangJadi extends Model
{
    protected $table = 'barang_jadi';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'nama',
        'pureng_plendes',
        'created_at',
        'updated_at',
    ];

    public function barang_masuk()
    {
        return $this->hasMany(BarangJadiMasuk::class, 'brg_jadi_id', 'id');
    }
    public function barang_keluar()
    {
        return $this->hasMany(BarangJadiKeluar::class, 'brg_jadi_id', 'id');
    }
    public function kebutuhan()
    {
        return $this->hasMany(KebutuhanBarangJadi::class, 'barang_jadi_id', 'id');
    }
}
