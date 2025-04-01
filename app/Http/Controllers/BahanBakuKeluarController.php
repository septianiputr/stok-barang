<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use App\Models\BahanBakuKeluar;
use App\Models\StokBahanBaku;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Date;

class BahanBakuKeluarController extends Controller
{
    public function show()
    {
        $bahanBakuKeluar = BahanBakuKeluar::with('bahan_baku')->orderBy('created_at', 'desc')->paginate(10);
        return view('bahan_baku_keluar.show', compact('bahanBakuKeluar'));
    }

    public function formTambah($kode_bahan)
    {
        $bahanBaku = BahanBaku::where('id', $kode_bahan)->first();
        $date = Carbon::parse(Date::now())->format('m/Y');
        // $stokBahanBaku = StokBahanBaku::where('bahan_baku_id', $kode_bahan)->where('tanggal', $date)->first();
        return view('bahan_baku_keluar.form_tambah', compact('bahanBaku'));
    }

    public function tambahBahanKeluar(Request $request)
    {
        $keluar = new BahanBakuKeluar();
        $keluar->bahan_baku_id = $request->kode_bahan;
        $keluar->jumlah = $request->jumlah;
        $keluar->keterangan = $request->keterangan;
        $keluar->created_at = $request->created_at;
        $keluar->updated_at = $request->created_at;
        $keluar->save();

        $date = Carbon::parse($request->created_at)->format('m/Y');

        $stokBahanBaku = StokBahanBaku::where('tanggal', $date)
            ->where('bahan_baku_id', $request->kode_bahan)
            ->first();
        $stokBahanBaku->jumlah_keluar += $request->jumlah;
        $stokBahanBaku->save();

        return redirect()->route('bahan-baku-keluar.show')->with('success', 'Bahan baku keluar berhasil ditambahkan');
    }


    public function formUbah($idKeluar)
    {
        $dataKeluar = BahanBakuKeluar::with('bahan_baku')->find($idKeluar);
        $date = Carbon::parse(Date::now())->format('m/Y');
        // $stokBahanBaku = StokBahanBaku::where('bahan_baku_id', $dataKeluar->bahan_baku_id)->where('tanggal', $date)->first();
        return view('bahan_baku_keluar.form_ubah', compact('dataKeluar'));
    }

    public function ubahBahanKeluar(Request $request, $idKeluar)
    {
        $dataKeluar = BahanBakuKeluar::find($idKeluar);
        $diff = $request->jumlah - $dataKeluar->jumlah;

        $dataKeluar->bahan_baku_id = $request->kode_bahan;
        $dataKeluar->jumlah = $request->jumlah;
        $dataKeluar->keterangan = $request->keterangan;
        $dataKeluar->created_at = $request->created_at;
        $dataKeluar->updated_at = $request->created_at;
        $dataKeluar->save();

        $date = Carbon::parse($request->created_at)->format('m/Y');

        $stokBahanBaku = StokBahanBaku::where('tanggal', $date)
            ->where('bahan_baku_id', $request->kode_bahan)
            ->first();
        $stokBahanBaku->jumlah_keluar += $diff;
        $stokBahanBaku->save();

        return redirect()->route('bahan-baku-keluar.show')->with('success', 'Bahan baku keluar berhasil diubah');
    }

    public function hapusBahanKeluar($idKeluar)
    {
        $dataKeluar = BahanBakuKeluar::find($idKeluar);

        $date = Carbon::parse($dataKeluar->created_at)->format('m/Y');

        $stokBahanBaku = StokBahanBaku::where('tanggal', $date)
            ->where('bahan_baku_id', $dataKeluar->bahan_baku_id)
            ->first();
        $stokBahanBaku->jumlah_keluar -= $dataKeluar->jumlah;

        $dataKeluar->delete();
        $stokBahanBaku->save();

        return redirect()->route('bahan-baku-keluar.show')->with('success', 'Bahan baku keluar berhasil dihapus');
    }

    // public function checkAndCreateDatabase($date, $bahanBakuId)
    // {
    //     $stokBahanBaku = StokBahanBaku::where('tanggal', $date)
    //         ->where('bahan_baku_id', $bahanBakuId)
    //         ->first();

    //     if ($stokBahanBaku) {
    //         return $stokBahanBaku;
    //     } else {
    //         $stokBahanBaku = new StokBahanBaku;
    //         $stokBahanBaku->tanggal = $date;
    //         $stokBahanBaku->bahan_baku_id = $bahanBakuId;
    //         $stokBahanBaku->stok_awal = 0;
    //         $stokBahanBaku->jumlah_masuk = 0;
    //         $stokBahanBaku->jumlah_keluar = 0;
    //         $stokBahanBaku->save();

    //         return $stokBahanBaku;
    //     }
    // }
}
