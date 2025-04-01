<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BarangJadi;
use App\Models\BarangJadiMasuk;
use App\Models\StokBarangJadi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BarangJadiMasukController extends Controller
{
    public function show()
    {
        $barangMasuk = BarangJadiMasuk::with('barang_jadi')->orderBy('created_at', 'desc')->paginate(10);
        return view('barang_jadi_masuk.show', compact('barangMasuk'));
    }

    public function formTambah($kode_barang = null)
    {
        $barangJadi = $kode_barang
            ? BarangJadi::where('id', $kode_barang)->get()
            : BarangJadi::all();
        return view('barang_jadi_masuk.form_tambah', compact('barangJadi'));
    }

    public function tambahBarangMasuk(Request $request)
    {
        $barangMasuk = new BarangJadiMasuk();
        $barangMasuk->brg_jadi_id = $request->kode_barang;
        $barangMasuk->jumlah = $request->jumlah;
        $barangMasuk->keterangan = $request->keterangan;
        $barangMasuk->created_at = $request->created_at;
        $barangMasuk->updated_at = $request->created_at;
        $barangMasuk->save();

        $date = Carbon::parse($request->created_at)->format('m/Y');

        $stokBarangJadi = StokBarangJadi::where('tanggal', $date)
            ->where('brg_jadi_id', $request->kode_barang)
            ->first();
        $stokBarangJadi->jumlah_masuk += $request->jumlah;

        $stokBarangJadi->save();

        return redirect()->route('barang-jadi-masuk.show')->with('success', 'Barang jadi masuk berhasil ditambahkan');
    }

    public function formUbah($id)
    {
        $barangMasuk = BarangJadiMasuk::where('id', $id)->first();
        return view('barang_jadi_masuk.form_ubah', compact('barangMasuk'));
    }

    public function ubahBarangMasuk(Request $request, $id)
    {
        $barangMasuk = BarangJadiMasuk::find($id);

        $diff = $request->jumlah - $barangMasuk->jumlah;

        $barangMasuk->jumlah = $request->jumlah;
        $barangMasuk->keterangan = $request->keterangan;
        $barangMasuk->created_at = $request->created_at;
        $barangMasuk->updated_at = $request->created_at;
        $barangMasuk->save();

        $date = Carbon::parse($request->created_at)->format('m/Y');

        $stokBarangJadi = StokBarangJadi::where('tanggal', $date)
            ->where('brg_jadi_id', $request->kode_barang)
            ->first();
        $stokBarangJadi->jumlah_masuk += $diff;
        $stokBarangJadi->save();

        return redirect()->route('barang-jadi-masuk.show')->with('success', 'Barang jadi masuk berhasil diubah');
    }

    public function hapusBarangMasuk($id)
    {
        $barangMasuk = BarangJadiMasuk::find($id);

        $date = Carbon::parse($barangMasuk->created_at)->format('m/Y');

        $stokBarangJadi = StokBarangJadi::where('tanggal', $date)
            ->where('brg_jadi_id', $barangMasuk->brg_jadi_id)
            ->first();
        $stokBarangJadi->jumlah_masuk -= $barangMasuk->jumlah;

        $barangMasuk->delete();
        $stokBarangJadi->save();

        return redirect()->route('barang-jadi-masuk.show')->with('success', 'Barang jadi masuk berhasil dihapus');
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
