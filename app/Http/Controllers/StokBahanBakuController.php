<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use App\Models\StokBahanBaku;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class StokBahanBakuController extends Controller
{
    public function show()
    {
        $date = Carbon::parse(Date::now())->format('m/Y');

        $bahanBaku = BahanBaku::all();

        $stokBahanBaku = StokBahanBaku::with('bahan_baku')
            ->where('tanggal', $date)
            ->get();

        return view('stok_bahan_baku.show', compact('stokBahanBaku', 'bahanBaku'));
    }
}
