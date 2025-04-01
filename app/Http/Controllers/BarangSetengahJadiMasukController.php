<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BarangSetengahJadi;
use App\Models\BarangSetengahJadiMasuk;
use App\Models\StokBarangSetengahJadi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BarangSetengahJadiMasukController extends Controller
{
    public function show()
    {
        $barangMasuk = BarangSetengahJadiMasuk::with('brg_setengah_jadi')->orderBy('created_at', 'desc')->paginate(10);
        return view('barang_setengah_jadi_masuk.show', compact('barangMasuk'));
    }

    public function formTambah($kode_barang = null)
    {
        $barangSetengahJadi = $kode_barang
            ? BarangSetengahJadi::where('id', $kode_barang)->get()
            : BarangSetengahJadi::all();
        return view('barang_setengah_jadi_masuk.form_tambah', compact('barangSetengahJadi'));
    }

    public function tambahBarangMasuk(Request $request)
    {
        $barangMasuk = new BarangSetengahJadiMasuk();
        $barangMasuk->brg_setengah_jadi_id = $request->kode_barang;
        $barangMasuk->jumlah = $request->jumlah;
        $barangMasuk->keterangan = $request->keterangan;
        $barangMasuk->created_at = $request->created_at;
        $barangMasuk->updated_at = $request->created_at;
        $barangMasuk->save();

        $date = Carbon::parse($request->created_at)->format('m/Y');

        $stokBarangSetengahJadi = StokBarangSetengahJadi::where('tanggal', $date)
            ->where('brg_setengah_jadi_id',  $request->kode_barang)
            ->first();
        $stokBarangSetengahJadi->jumlah_masuk += $request->jumlah;

        $stokBarangSetengahJadi->save();

        return redirect()->route('barang-setengah-jadi-masuk.show')->with('success', 'Barang setengah jadi masuk berhasil ditambahkan');
    }

    public function formUbah($id)
    {
        $barangMasuk = BarangSetengahJadiMasuk::where('id', $id)->first();
        return view('barang_setengah_jadi_masuk.form_ubah', compact('barangMasuk'));
    }

    public function ubahBarangMasuk(Request $request, $id)
    {
        $barangMasuk = BarangSetengahJadiMasuk::find($id);

        $diff = $request->jumlah - $barangMasuk->jumlah;

        $barangMasuk->jumlah = $request->jumlah;
        $barangMasuk->keterangan = $request->keterangan;
        $barangMasuk->created_at = $request->created_at;
        $barangMasuk->updated_at = $request->created_at;
        $barangMasuk->save();

        $date = Carbon::parse($request->created_at)->format('m/Y');

        $stokBarangSetengahJadi = StokBarangSetengahJadi::where('tanggal', $date)
            ->where('brg_setengah_jadi_id',  $request->kode_barang)
            ->first();
        $stokBarangSetengahJadi->jumlah_masuk += $diff;
        $stokBarangSetengahJadi->save();

        return redirect()->route('barang-setengah-jadi-masuk.show')->with('success', 'Barang setengah jadi masuk berhasil diubah');
    }

    public function hapusBarangMasuk($id)
    {
        $barangMasuk = BarangSetengahJadiMasuk::find($id);

        $date = Carbon::parse($barangMasuk->created_at)->format('m/Y');

        $stokBarangSetengahJadi = StokBarangSetengahJadi::where('tanggal', $date)
            ->where('brg_setengah_jadi_id', $barangMasuk->brg_setengah_jadi_id)
            ->first();
        $stokBarangSetengahJadi->jumlah_masuk -= $barangMasuk->jumlah;
        $barangMasuk->delete();
        $stokBarangSetengahJadi->save();

        return redirect()->route('barang-setengah-jadi-masuk.show')->with('success', 'Barang setengah jadi masuk berhasil dihapus');
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
