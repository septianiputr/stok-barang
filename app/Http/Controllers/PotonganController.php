<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use App\Models\Potongan;
use Illuminate\Http\Request;

class PotonganController extends Controller
{
    public function show()
    {
        $potongan = Potongan::all();
        return view('potongan.show', compact('potongan'));
    }

    public function formTambah()
    {
        $bahanBaku = BahanBaku::where('jenis', 'pipa')->get();
        return view('potongan.form_tambah', compact('bahanBaku'));
    }

    public function tambahPotongan(Request $request)
    {
        $potongan = new Potongan();
        $potongan->nama = $request->nama;
        $potongan->bahan_baku_id = $request->bahan_baku_id;
        $potongan->angka_potong = $request->angka_potong;
        $potongan->save();

        return redirect()->route('potongan.show')->with('success', 'Potongan berhasil ditambahkan');
    }

    public function formUbah($id)
    {
        $potongan = Potongan::where('id', $id)->first();
        $bahanBaku = BahanBaku::all();
        return view('potongan.form_ubah', compact('potongan', 'bahanBaku'));
    }

    public function ubahPotongan(Request $request, $id)
    {
        $potongan = Potongan::where('id', $id)->first();
        $potongan->nama = $request->nama;
        $potongan->bahan_baku_id = $request->bahan_baku_id;
        $potongan->angka_potong = $request->angka_potong;
        $potongan->save();

        return redirect()->route('potongan.show')->with('success', 'Potongan berhasil diubah');
    }

    public function hapusPotongan($id)
    {
        $potongan = Potongan::where('id', $id)->first();
        $potongan->delete();

        return redirect()->route('potongan.show')->with('success', 'Potongan berhasil dihapus');
    }
}
