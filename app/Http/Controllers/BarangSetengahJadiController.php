<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BarangSetengahJadi;
use App\Models\StokBarangSetengahJadi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class BarangSetengahJadiController extends Controller
{
    public function show()
    {
        $barangSetengahJadi = BarangSetengahJadi::all();
        return view('barang_setengah_jadi.show', compact('barangSetengahJadi'));
    }

    public function formTambah()
    {
        return view('barang_setengah_jadi.form_tambah');
    }

    public function tambahBarang(Request $request)
    {
        $isExist = BarangSetengahJadi::where('id', $request->id)->first();

        if ($isExist) {
            return redirect()->route('barang-setengah-jadi.form-tambah')->with('error', 'Kode tersebut sudah digunakan');
        }

        $barangSetengahJadi = new BarangSetengahJadi();
        $barangSetengahJadi->id = $request->id;
        $barangSetengahJadi->nama = $request->nama;

        $barangSetengahJadi->save();

        $date = Carbon::parse(Date::now())->format('m/Y');

        $stokBarangSetengahJadi = new StokBarangSetengahJadi();
        $stokBarangSetengahJadi->tanggal = $date;
        $stokBarangSetengahJadi->brg_setengah_jadi_id = $request->id;
        $stokBarangSetengahJadi->stok_awal = 0;
        $stokBarangSetengahJadi->jumlah_masuk = 0;
        $stokBarangSetengahJadi->jumlah_keluar = 0;
        $stokBarangSetengahJadi->save();

        return redirect()->route('barang-setengah-jadi.show')->with('success', 'Barang Setengah jadi berhasil ditambahkan');
    }

    public function formUbah($id)
    {
        $barangSetengahJadi = BarangSetengahJadi::where('id', $id)->first();
        return view('barang_setengah_jadi.form_ubah', compact('barangSetengahJadi'));
    }

    public function ubahBarang(Request $request, $id)
    {
        $isExist = BarangSetengahJadi::where('id', $request->id)->first();
        if ($isExist && $isExist->id != $id) {
            return redirect()->route('barang-setengah-jadi.show')->with('error', 'Kode tersebut sudah digunakan');
        }

        $barangSetengahJadi = BarangSetengahJadi::where('id', $id)->first();
        $barangSetengahJadi->id = $request->id;
        $barangSetengahJadi->nama = $request->nama;
        $barangSetengahJadi->updated_at = Date::now();

        $barangSetengahJadi->save();
        return redirect()->route('barang-setengah-jadi.show')->with('success', 'Barang Setengah jadi berhasil diubah');
    }

    public function hapusBarang($id)
    {
        $barangSetengahJadi = BarangSetengahJadi::where('id', $id)->first();
        $barangSetengahJadi->delete();

        return redirect()->route('barang-setengah-jadi.show')->with('success', 'Barang Setengah jadi berhasil dihapus');
    }
}
