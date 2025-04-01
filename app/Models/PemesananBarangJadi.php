<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemesananBarangJadi extends Model
{
    protected $table = 'pemesanan';
    protected $fillable = ['customer_id', 'created_at', 'updated_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function pemesanan_detail()
    {
        return $this->hasMany(PemesananBarangJadiDetail::class, 'pemesanan_id', 'id');
    }
}
