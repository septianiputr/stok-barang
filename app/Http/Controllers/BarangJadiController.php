<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use App\Models\BarangJadi;
use App\Models\KebutuhanBarangJadi;
use App\Models\Potongan;
use App\Models\StokBarangJadi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class BarangJadiController extends Controller
{
    public function show()
    {
        $barangJadi = BarangJadi::all();
        return view('barang_jadi.show', compact('barangJadi'));
    }

    public function formTambah()
    {
        return view('barang_jadi.form_tambah');
    }

    public function tambahBarang(Request $request)
    {
        $isExist = BarangJadi::where('id', $request->id)->first();

        if ($isExist) {
            return redirect()->route('barang-jadi.form-tambah')->with('error', 'Kode tersebut sudah digunakan');
        }

        $barangJadi = new BarangJadi();
        $barangJadi->id = $request->id;
        $barangJadi->nama = $request->nama;

        $barangJadi->save();

        $date = Carbon::parse(Date::now())->format('m/Y');

        $stokBarangJadi = new StokBarangJadi();
        $stokBarangJadi->tanggal = $date;
        $stokBarangJadi->brg_jadi_id = $request->id;
        $stokBarangJadi->stok_awal = 0;
        $stokBarangJadi->jumlah_masuk = 0;
        $stokBarangJadi->jumlah_keluar = 0;
        $stokBarangJadi->save();

        return redirect()->route('barang-jadi.show')->with('success', 'Barang jadi berhasil ditambahkan');
    }

    public function formUbah($id)
    {
        $barangJadi = BarangJadi::where('id', $id)->first();
        $kebutuhanBarangJadi = KebutuhanBarangJadi::where('barang_jadi_id', $id)->get();
        return view('barang_jadi.form_ubah', compact('barangJadi', 'kebutuhanBarangJadi'));
    }

    public function ubahBarang(Request $request, $id)
    {
        $isExist = BarangJadi::where('id', $request->id)->first();
        if ($isExist && $isExist->id != $id) {
            return redirect()->route('barang-jadi.show')->with('error', 'Kode tersebut sudah digunakan');
        }

        $barangJadi = BarangJadi::where('id', $id)->first();
        $barangJadi->id = $request->id;
        $barangJadi->nama = $request->nama;
        $barangJadi->updated_at = Date::now();

        $barangJadi->save();
        return redirect()->route('barang-jadi.show')->with('success', 'Barang jadi berhasil diubah');
    }

    public function hapusBarang($id)
    {
        $barangJadi = BarangJadi::where('id', $id)->first();
        $barangJadi->delete();

        return redirect()->route('barang-jadi.show')->with('success', 'Barang jadi berhasil dihapus');
    }

    public function kebutuhanForm($id)
    {
        $bahanBaku = BahanBaku::all();
        $potongan = Potongan::all();
        $barangJadi = BarangJadi::where('id', $id)->first();
        return view('barang_jadi.kebutuhan.form_tambah', compact('bahanBaku', 'potongan', 'barangJadi'));
    }

    public function kebutuhanTambah(Request $request, $id)
    {

        $bahanBaku = BahanBaku::where('id', $request->bahan_baku_id)->first();

        $kebutuhanBarangJadi = new KebutuhanBarangJadi();
        $kebutuhanBarangJadi->barang_jadi_id = $id;

        if ($bahanBaku->jenis == 'pipa') {
            $kebutuhanBarangJadi->bahan_baku_id = $request->potongan_id;
            $kebutuhanBarangJadi->table_source = 'potongan';
        } else {
            $kebutuhanBarangJadi->bahan_baku_id = $request->bahan_baku_id;
            $kebutuhanBarangJadi->table_source = 'bahan_baku';
        }

        $kebutuhanBarangJadi->jumlah_kebutuhan = $request->jumlah;
        $kebutuhanBarangJadi->save();

        return redirect()->route('barang-jadi.form-ubah', $id)->with('success', 'Kebutuhan barang jadi berhasil ditambahkan');
    }

    public function kebutuhanHapus($id, $kebutuhanId)
    {
        $kebutuhanBarangJadi = KebutuhanBarangJadi::where('id', $kebutuhanId)->first();
        if ($kebutuhanBarangJadi) {
            $kebutuhanBarangJadi->delete();
            return redirect()->route('barang-jadi.form-ubah', $id)->with('success', 'Kebutuhan barang jadi berhasil dihapus');
        }
        return redirect()->route('barang-jadi.form-ubah', $id)->with('error', 'Kebutuhan barang jadi tidak ditemukan');
    }
}
