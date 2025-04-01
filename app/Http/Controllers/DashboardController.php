<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\BahanBakuKeluar;
use App\Models\BahanBakuMasuk;
use App\Models\BarangJadiKeluar;
use App\Models\DataBarangJadi;
use App\Models\PemesananBahanBaku;
use App\Models\StokBahanBaku;
use App\Models\StokBarangJadi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil tahun saat ini
        $currentYear = Carbon::now()->year;

        // Ambil data stok bahan baku untuk satu tahun terakhir
        $stokBahanBaku = StokBahanBaku::where('tanggal', 'like', '%/' . $currentYear)
            ->orderBy('tanggal')
            ->get();

        // Ambil data stok barang jadi untuk satu tahun terakhir
        $stokBarangJadi = StokBarangJadi::where('tanggal', 'like', '%/' . $currentYear)
            ->orderBy('tanggal')
            ->get();

        // Format data untuk chart
        $labels = [];
        $dataBahanBaku = [];
        $dataBarangJadi = [];

        // Loop untuk setiap bulan (Januari - Desember)
        for ($month = 1; $month <= 12; $month++) {
            $monthPadded = str_pad($month, 2, '0', STR_PAD_LEFT); // Format bulan ke "01", "02", ..., "12"
            $labels[] = Carbon::create()->month($month)->format('F'); // Nama bulan (e.g., January)

            // Hitung total stok bahan baku untuk bulan ini
            $totalBahanBaku = $stokBahanBaku->filter(function ($item) use ($monthPadded, $currentYear) {
                return substr($item->tanggal, 0, 2) == $monthPadded && substr($item->tanggal, 3) == $currentYear;
            })->sum(function ($item) {
                return $item->stok_awal + $item->jumlah_masuk - $item->jumlah_keluar; // Rumus jumlah stok
            });

            $dataBahanBaku[] = $totalBahanBaku;

            // Hitung total stok barang jadi untuk bulan ini
            $totalBarangJadi = $stokBarangJadi->filter(function ($item) use ($monthPadded, $currentYear) {
                return substr($item->tanggal, 0, 2) == $monthPadded && substr($item->tanggal, 3) == $currentYear;
            })->sum(function ($item) {
                return $item->stok_awal + $item->jumlah_masuk - $item->jumlah_keluar; // Rumus jumlah stok
            });

            $dataBarangJadi[] = $totalBarangJadi;
        }

        return view('dashboard.index', compact('labels', 'dataBahanBaku', 'dataBarangJadi'));
    }
}
