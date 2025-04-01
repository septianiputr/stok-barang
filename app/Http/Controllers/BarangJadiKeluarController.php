<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BarangJadi;
use App\Models\BarangJadiKeluar;
use App\Models\StokBarangJadi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class BarangJadiKeluarController extends Controller
{
    public function show()
    {
        $barangKeluar = BarangJadiKeluar::with('barang_jadi')->orderBy('created_at', 'desc')->paginate(10);
        return view('barang_jadi_keluar.show', compact('barangKeluar'));
    }

    public function formTambah($kode_barang)
    {
        $barangJadi = BarangJadi::where('id', $kode_barang)->first();
        $date = Carbon::parse(Date::now())->format('m/Y');
        // $stokBarangJadi = StokBarangJadi::where('brg_jadi_id', $kode_barang)->where('tanggal', $date)->first();
        return view('barang_jadi_keluar.form_tambah', compact('barangJadi'));
    }

    public function tambahBarangKeluar(Request $request)
    {
        $barangKeluar = new BarangJadiKeluar();
        $barangKeluar->brg_jadi_id = $request->kode_barang;
        $barangKeluar->jumlah = $request->jumlah;
        $barangKeluar->keterangan = $request->keterangan;
        $barangKeluar->created_at = $request->created_at;
        $barangKeluar->updated_at = $request->created_at;

        $barangKeluar->save();

        $date = Carbon::parse($request->created_at)->format('m/Y');

        $stokBarangJadi = StokBarangJadi::where('tanggal', $date)
            ->where('brg_jadi_id', $request->kode_barang)
            ->first();
        $stokBarangJadi->jumlah_keluar += $request->jumlah;
        $stokBarangJadi->save();

        return redirect()->route('barang-jadi-keluar.show')->with('success', 'Barang jadi keluar berhasil diubah');
    }


    public function formUbah($idKeluar)
    {
        $barangKeluar = BarangJadiKeluar::find($idKeluar);
        $date = Carbon::parse(Date::now())->format('m/Y');
        // $stokBarangJadi = StokBarangJadi::where('brg_jadi_id', $barangKeluar->brg_jadi_id)->where('tanggal', $date)->first();
        return view('barang_jadi_keluar.form_ubah', compact('barangKeluar'));
    }

    public function ubahBarangKeluar(Request $request, $idKeluar)
    {
        $dataKeluar = BarangJadiKeluar::find($idKeluar);
        $diff = $request->jumlah - $dataKeluar->jumlah;

        $dataKeluar->brg_jadi_id = $request->kode_barang;
        $dataKeluar->jumlah = $request->jumlah;
        $dataKeluar->keterangan = $request->keterangan;
        $dataKeluar->created_at = $request->created_at;
        $dataKeluar->updated_at = $request->created_at;
        $dataKeluar->save();

        $date = Carbon::parse($request->created_at)->format('m/Y');

        $stokBarangJadi = StokBarangJadi::where('tanggal', $date)
            ->where('brg_jadi_id', $request->kode_barang)
            ->first();
        $stokBarangJadi->jumlah_keluar += $diff;
        $stokBarangJadi->save();

        return redirect()->route('barang-jadi-keluar.show')->with('success', 'Barang jadi keluar berhasil diubah');
    }

    public function hapusBarangKeluar($idKeluar)
    {
        $dataKeluar = BarangJadiKeluar::find($idKeluar);
        $date = Carbon::parse($dataKeluar->created_at)->format('m/Y');

        $stokBarangJadi = StokBarangJadi::where('tanggal', $date)
            ->where('brg_jadi_id', $dataKeluar->brg_jadi_id)
            ->first();

        $stokBarangJadi->jumlah_keluar -= $dataKeluar->jumlah;

        $dataKeluar->delete();
        $stokBarangJadi->save();

        return redirect()->route('barang-jadi-keluar.show')->with('success', 'Barang jadi keluar berhasil dihapus');
    }

    // public function checkAndCreateDatabase($date, $barangId)
    // {
    //     $stokBarangJadi = StokBarangJadi::where('tanggal', $date)
    //         ->where('brg_jadi_id', $barangId)
    //         ->first();

    //     if ($stokBarangJadi) {
    //         return $stokBarangJadi;
    //     } else {
    //         $stokBarangJadi = new StokBarangJadi();
    //         $stokBarangJadi->tanggal = $date;
    //         $stokBarangJadi->brg_jadi_id = $barangId;
    //         $stokBarangJadi->stok_awal = 0;
    //         $stokBarangJadi->jumlah_masuk = 0;
    //         $stokBarangJadi->jumlah_keluar = 0;
    //         $stokBarangJadi->save();

    //         return $stokBarangJadi;
    //     }
    // }
}
