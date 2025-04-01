<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use App\Models\PemesananBahanBaku;
use App\Models\StokBahanBaku;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class PemesananBahanBakuController extends Controller
{

    public function show()
    {
        $pemesananBahanBaku = PemesananBahanBaku::with('bahan_baku')->orderBy('created_at', 'desc')->paginate(5);
        return view('pemesanan_bahan_baku.show', compact('pemesananBahanBaku'));
    }

    public function formTambah($kode_bahan = null)
    {
        $bahan_baku = $kode_bahan
            ? BahanBaku::where('id', $kode_bahan)->get()
            : BahanBaku::all();
        return view('pemesanan_bahan_baku.form_tambah', compact('bahan_baku'));
    }

    public function create(Request $request)
    {
        $pesanan = new PemesananBahanBaku();
        $pesanan->bahan_baku_id = $request->kode_bahan;
        $pesanan->jumlah = $request->jumlah;
        $pesanan->keterangan = $request->keterangan;
        $pesanan->created_at = $request->created_at;
        $pesanan->updated_at = $request->created_at;
        $pesanan->save();

        $date = Carbon::parse($request->created_at)->format('m/Y');

        $stokBahanBaku = StokBahanBaku::where('tanggal', $date)
            ->where('bahan_baku_id', $request->kode_bahan)
            ->first();
        $stokBahanBaku->jumlah_masuk += $request->jumlah;
        $stokBahanBaku->save();

        return redirect()->route('pemesanan-bahan-baku.show')->with('success', 'Pemesanan berhasil');
    }

    public function formEdit($idPesanan)
    {
        $pemesanan = PemesananBahanBaku::find($idPesanan);
        return view('pemesanan_bahan_baku.form_edit', compact('pemesanan'));
    }

    public function updatePemesanan(Request $request, $idPesanan)
    {

        $pesanan = PemesananBahanBaku::find($idPesanan);

        $diff = $request->jumlah - $pesanan->jumlah;

        $pesanan->jumlah = $request->jumlah;
        $pesanan->keterangan = $request->keterangan;
        $pesanan->updated_at = $request->created_at;
        $pesanan->created_at = $request->created_at;
        $pesanan->save();

        $date = Carbon::parse($request->created_at)->format('m/Y');

        $stokBahanBaku = StokBahanBaku::where('tanggal', $date)
            ->where('bahan_baku_id', $pesanan->bahan_baku_id)
            ->first();
        $stokBahanBaku->jumlah_masuk += $diff;
        $stokBahanBaku->save();

        return redirect()->route('pemesanan-bahan-baku.show')->with('success', 'Pemesanan berhasil diubah');
    }

    public function hapusPemesanan($idPesanan)
    {
        $pesanan = PemesananBahanBaku::find($idPesanan);

        $date = Carbon::parse($pesanan->created_at)->format('m/Y');

        $stokBahanBaku = StokBahanBaku::where('tanggal', $date)
            ->where('bahan_baku_id', $pesanan->bahan_baku_id)
            ->first();
        $stokBahanBaku->jumlah_masuk -= $pesanan->jumlah;

        $pesanan->delete();
        $stokBahanBaku->save();

        return redirect()->route('pemesanan-bahan-baku.show')->with('success', 'Pemesanan berhasil dihapus');
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
