<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    use HasFactory;

    protected $table = 'bahan_baku';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'nama', 'jenis', 'minimal'];
    

    public function stok_bahan_baku()
    {
        return $this->hasMany(StokBahanBaku::class, 'bahan_baku_id', 'id');
    }


}
