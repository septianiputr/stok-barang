<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KebutuhanBarangJadi extends Model
{
    protected $table = 'kebutuhan_barang_jadi';
    protected $fillable = ['barang_jadi_id', 'bahan_baku_id', 'table_source', 'jumlah_kebutuhan'];

    public function barang_jadi()
    {
        return $this->belongsTo(BarangJadi::class, 'barang_jadi_id', 'id');
    }

    public function bahan_baku()
    {
        if ($this->table_source == 'bahan_baku') {
            return $this->belongsTo(BahanBaku::class, 'bahan_baku_id', 'id');
        } elseif ($this->table_source == 'potongan') {
            return $this->belongsTo(Potongan::class, 'bahan_baku_id', 'id');
        }
    }

    public function scopeByTableSource($query, $tableSource)
    {
        return $query->where('table_source', $tableSource);
    }
}
