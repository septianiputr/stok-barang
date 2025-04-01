<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use App\Models\BahanBakuKeluar;
use App\Models\StokBahanBaku;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class BahanBakuController extends Controller
{
    public function show()
    {
        $bahanBaku = BahanBaku::all();
        return view('bahan_baku.show', compact('bahanBaku'));
    }

    public function formTambah()
    {
        return view('bahan_baku.form_tambah');
    }

    public function tambahBahan(Request $request)
    {
        $isAlreadyExist = BahanBaku::where('id', $request->id)->first();
        if ($isAlreadyExist) {
            return redirect()->route('bahan-baku.form-tambah')->with('error', 'ID bahan baku sudah ada');
        }

        $bahan = new BahanBaku();
        $bahan->id = $request->id;
        $bahan->nama = $request->nama;
        $bahan->jenis = $request->jenis;
        $bahan->minimal = $request->minimal;
        $bahan->save();

        $date = Carbon::parse(Date::now())->format('m/Y');

        $stokBahanBaku = new StokBahanBaku();
        $stokBahanBaku->tanggal = $date;
        $stokBahanBaku->bahan_baku_id = $request->id;
        $stokBahanBaku->stok_awal = 0;
        $stokBahanBaku->jumlah_masuk = 0;
        $stokBahanBaku->jumlah_keluar = 0;
        $stokBahanBaku->save();

        return redirect()->route('bahan-baku.show')->with('success', 'Bahan baku berhasil ditambahkan');
    }

    public function formUbah($id)
    {
        $bahan = BahanBaku::where('id', $id)->first();
        return view('bahan_baku.form_ubah', compact('bahan'));
    }

    public function ubahBahan(Request $request, $id)
    {

        $isAlreadyExist = BahanBaku::where('id', $request->id)->first();
        if ($isAlreadyExist && $isAlreadyExist->id !== $id) {
            return redirect()->route('bahan-baku.form-ubah', $id)->with('error', 'ID bahan baku sudah ada');
        }

        $bahan = BahanBaku::where('id', $id)->first();
        $bahan->id = $request->id;
        $bahan->nama = $request->nama;
        $bahan->jenis = $request->jenis;
        $bahan->minimal = $request->minimal;
        $bahan->save();

        return redirect()->route('bahan-baku.show')->with('success', 'Bahan baku berhasil diubah');
    }

    public function hapusBahan($id)
    {
        $bahan = BahanBaku::where('id', $id)->first();
        $bahan->delete();

        return redirect()->route('bahan-baku.show')->with('success', 'Bahan baku berhasil dihapus');
    }
}
