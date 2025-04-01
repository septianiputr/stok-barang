<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BarangSetengahJadi;
use App\Models\BarangSetengahJadiKeluar;
use App\Models\StokBarangSetengahJadi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class BarangSetengahJadiKeluarController extends Controller
{
    public function show()
    {
        $barangKeluar = BarangSetengahJadiKeluar::with('brg_setengah_jadi')->orderBy('created_at', 'desc')->paginate(10);
        return view('barang_setengah_jadi_keluar.show', compact('barangKeluar'));
    }

    public function formTambah($kode_barang)
    {
        $barangSetengahJadi = BarangSetengahJadi::where('id', $kode_barang)->first();
        $date = Carbon::parse(Date::now())->format('m/Y');
        // $stokBarangSetengahJadi = StokBarangSetengahJadi::where('brg_setengah_jadi_id', $kode_barang)->where('tanggal', $date)->first();
        return view('barang_setengah_jadi_keluar.form_tambah', compact('barangSetengahJadi'));
    }

    public function tambahBarangKeluar(Request $request)
    {
        $barangKeluar = new BarangSetengahJadiKeluar();
        $barangKeluar->brg_setengah_jadi_id = $request->kode_barang;
        $barangKeluar->jumlah = $request->jumlah;
        $barangKeluar->keterangan = $request->keterangan;
        $barangKeluar->created_at = $request->created_at;
        $barangKeluar->updated_at = $request->created_at;

        $barangKeluar->save();

        $date = Carbon::parse($request->created_at)->format('m/Y');

        $stokBarangSetengahJadi = StokBarangSetengahJadi::where('tanggal', $date)
            ->where('brg_setengah_jadi_id', $request->kode_barang)
            ->first();
        $stokBarangSetengahJadi->jumlah_keluar += $request->jumlah;
        $stokBarangSetengahJadi->save();

        return redirect()->route('barang-setengah-jadi-keluar.show')->with('success', 'Barang setengah jadi keluar berhasil diubah');
    }


    public function formUbah($idKeluar)
    {
        $barangKeluar = BarangSetengahJadiKeluar::find($idKeluar);
        $date = Carbon::parse(Date::now())->format('m/Y');
        // $stokBarangSetengahJadi = StokBarangSetengahJadi::where('brg_setengah_jadi_id', $barangKeluar->brg_setengah_jadi_id)->where('tanggal', $date)->first();
        return view('barang_setengah_jadi_keluar.form_ubah', compact('barangKeluar'));
    }

    public function ubahBarangKeluar(Request $request, $idKeluar)
    {
        $dataKeluar = BarangSetengahJadiKeluar::find($idKeluar);
        $diff = $request->jumlah - $dataKeluar->jumlah;

        $dataKeluar->brg_setengah_jadi_id = $request->kode_barang;
        $dataKeluar->jumlah = $request->jumlah;
        $dataKeluar->keterangan = $request->keterangan;
        $dataKeluar->created_at = $request->created_at;
        $dataKeluar->updated_at = $request->created_at;

        $dataKeluar->save();

        $date = Carbon::parse($request->created_at)->format('m/Y');

        $stokBarangSetengahJadi = StokBarangSetengahJadi::where('tanggal', $date)
            ->where('brg_setengah_jadi_id', $request->kode_barang)
            ->first();
        $stokBarangSetengahJadi->jumlah_keluar += $diff;
        $stokBarangSetengahJadi->save();

        return redirect()->route('barang-setengah-jadi-keluar.show')->with('success', 'Barang setengah jadi keluar berhasil diubah');
    }

    public function hapusBarangKeluar($idKeluar)
    {
        $dataKeluar = BarangSetengahJadiKeluar::find($idKeluar);
        $date = Carbon::parse($dataKeluar->created_at)->format('m/Y');

        $stokBarangSetengahJadi = StokBarangSetengahJadi::where('tanggal', $date)
            ->where('brg_setengah_jadi_id', $dataKeluar->brg_setengah_jadi_id)
            ->first();
        $stokBarangSetengahJadi->jumlah_keluar -= $dataKeluar->jumlah;

        $dataKeluar->delete();
        $stokBarangSetengahJadi->save();

        return redirect()->route('barang-setengah-jadi-keluar.show')->with('success', 'Barang setengah jadi keluar berhasil dihapus');
    }

    // public function checkAndCreateDatabase($date, $barangId)
    // {
    //     $stokBarangSetengahJadi = StokBarangSetengahJadi::where('tanggal', $date)
    //         ->where('brg_setengah_jadi_id', $barangId)
    //         ->first();

    //     if ($stokBarangSetengahJadi) {
    //         return $stokBarangSetengahJadi;
    //     } else {
    //         $stokBarangSetengahJadi = new StokBarangSetengahJadi;
    //         $stokBarangSetengahJadi->tanggal = $date;
    //         $stokBarangSetengahJadi->brg_setengah_jadi_id = $barangId;
    //         $stokBarangSetengahJadi->stok_awal = 0;
    //         $stokBarangSetengahJadi->jumlah_masuk = 0;
    //         $stokBarangSetengahJadi->jumlah_keluar = 0;
    //         $stokBarangSetengahJadi->save();

    //         return $stokBarangSetengahJadi;
    //     }
    // }
}
