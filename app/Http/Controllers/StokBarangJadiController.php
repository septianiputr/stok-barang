<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BarangJadi;
use App\Models\StokBarangJadi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class StokBarangJadiController extends Controller
{
    public function show()
    {
        $date = Carbon::parse(Date::now())->format('m/Y');

        $barangJadi = BarangJadi::all();

        $stokBarangJadi = StokBarangJadi::with('barang_jadi')->where('tanggal', $date)->get();

        return view('stok_barang_jadi.show', compact('stokBarangJadi', 'barangJadi'));
    }
}
