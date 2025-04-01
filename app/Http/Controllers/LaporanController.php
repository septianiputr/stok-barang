<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\BahanBakuKeluar;
use App\Models\BarangJadi;
use App\Models\BarangJadiKeluar;
use App\Models\BarangJadiMasuk;
use App\Models\BarangSetengahJadi;
use App\Models\BarangSetengahJadiKeluar;
use App\Models\BarangSetengahJadiMasuk;
use App\Models\DataBarangJadi;
use App\Models\DataBarangSetengahJadi;
use App\Models\PemesananBahanBaku;
use App\Models\StokBahanBaku;
use App\Models\StokBarangJadi;
use App\Models\StokBarangSetengahJadi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function generatePDF(Request $request)
    {
        // Ambil data dari request
        $kategori = $request->kategori;
        $date = $request->bulan_tahun;
        $bulan_tahun = "";

        if (!$date) {
            $bulan_tahun = Carbon::parse(Carbon::now())->translatedFormat('F Y');
            $date = Carbon::now()->format('m/Y');
        } else {
            $date = Carbon::parse($date)->format('m/Y');
            $bulan_tahun = Carbon::parse($request->bulan_tahun)->translatedFormat('F Y');
        }

        if ($kategori === 'bahan-baku') {
            $bahanBaku = BahanBaku::all();
            $stokBahanBaku = $this->generatePDFBahanBaku($date);
            $pdf = \PDF::loadView('laporan.template-lap-bahan-baku', compact('stokBahanBaku', 'bulan_tahun', 'bahanBaku'));
            return $pdf->download('laporan_' . strtolower(str_replace(' ', '_', $kategori)) . '-' . $bulan_tahun . '.pdf');
        } else if ($kategori === 'barang-setengah-jadi') {
            $barangSetengahJadi = BarangSetengahJadi::all();
            $stokBarangSetengahJadi = $this->generatePDFBarangSetengahJadi($date);
            $pdf = \PDF::loadView('laporan.template-lap-barang-set-jadi', compact('stokBarangSetengahJadi', 'bulan_tahun', 'barangSetengahJadi'));
            return $pdf->download('laporan_' . strtolower(str_replace(' ', '_', $kategori)) . '-' . $bulan_tahun . '.pdf');
        } else {
            $barangJadi = BarangJadi::all();
            $stokBarangJadi = $this->generatePDFBarangJadi($date);
            $pdf = \PDF::loadView('laporan.template-lap-barang-jadi', compact('stokBarangJadi', 'bulan_tahun', 'barangJadi'));
            return $pdf->download('laporan_' . strtolower(str_replace(' ', '_', $kategori)) . '-' . $bulan_tahun . '.pdf');
        }
    }

    public function generatePDFBahanBaku($date)
    {
        $stokBahanBaku = StokBahanBaku::with('bahan_baku')
            ->where('tanggal', $date)
            ->get();

        return $stokBahanBaku;
    }

    public function generatePDFBarangSetengahJadi($date)
    {
        $stokBarangSetengahJadi = StokBarangSetengahJadi::with('brg_setengah_jadi')
            ->where('tanggal', $date)
            ->get();
        return $stokBarangSetengahJadi;
    }

    public function generatePDFBarangJadi($date)
    {
        $stokBarangJadi = StokBarangJadi::with('barang_jadi')
            ->where('tanggal', $date)
            ->get();
        return $stokBarangJadi;
    }
}
