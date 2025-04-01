<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BarangSetengahJadi;
use App\Models\StokBarangSetengahJadi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class StokBarangSetengahJadiController extends Controller
{
    public function show()
    {
        $date = Carbon::parse(Date::now())->format('m/Y');

        $barangSetengahJadi = BarangSetengahJadi::all();

        $stokBarangSetengahJadi = StokBarangSetengahJadi::with('brg_setengah_jadi')->where('tanggal', $date)->get();
        return view('stok_barang_setengah_jadi.show', compact('stokBarangSetengahJadi', 'barangSetengahJadi'));
    }
}
