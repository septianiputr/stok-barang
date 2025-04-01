<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use App\Models\BarangJadi;
use App\Models\Customer;
use App\Models\KebutuhanBarangJadi;
use App\Models\PemesananBarangJadi;
use App\Models\PemesananBarangJadiDetail;
use App\Models\Potongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class PemesananBarangJadiController extends Controller
{
    public function show()
    {
        $pemesananBarangJadi = PemesananBarangJadi::orderBy('created_at', 'desc')->paginate(10);
        return view('pemesanan_barang_jadi.show', compact('pemesananBarangJadi'));
    }

    public function formTambah()
    {
        $barangJadi = BarangJadi::all();
        $customers = Customer::all();

        return view('pemesanan_barang_jadi.form_tambah', compact('barangJadi', 'customers'));
    }

    public function tambah(Request $request)
    {
        $pemesanan = new PemesananBarangJadi();
        $pemesanan->customer_id = $request->customer_id;
        $pemesanan->created_at = Date::now();
        $pemesanan->save();

        $pemesananDetail = new PemesananBarangJadiDetail();
        $pemesananDetail->pemesanan_id = $pemesanan->id;
        $pemesananDetail->barang_jadi_id = $request->kode_barang;
        $pemesananDetail->jumlah = $request->jumlah;
        $pemesananDetail->jumlah_jadi = 0;
        $pemesananDetail->created_at = Date::now();
        $pemesananDetail->updated_at = Date::now();
        $pemesananDetail->save();

        return redirect(route('pemesanan-barang-jadi.form-ubah', $pemesanan->id));
    }

    public function formUbah($id_pesanan)
    {
        $pemesanan = PemesananBarangJadi::where('id', $id_pesanan)->first();
        $barangJadi = BarangJadi::all();
        $customers = Customer::all();

        return view('pemesanan_barang_jadi.form_ubah', compact('pemesanan', 'barangJadi', 'customers'));
    }

    public function ubah(Request $request, $id_pesanan)
    {
        $pemesanan = PemesananBarangJadi::where('id', $id_pesanan)->first();
        if ($request->customer_id) {
            $pemesanan->customer_id = $request->customer_id;
            $pemesanan->save();

            return redirect()->route('pemesanan-barang-jadi.form-ubah', $id_pesanan)->with('success', "Customer berhasil diubah");
        }
        if ($request->kode_barang && $request->jumlah) {
            $pemesananDetail = new PemesananBarangJadiDetail();
            $pemesananDetail->pemesanan_id = $id_pesanan;
            $pemesananDetail->barang_jadi_id = $request->kode_barang;
            $pemesananDetail->jumlah = $request->jumlah;
            $pemesananDetail->jumlah_jadi = 0;
            $pemesananDetail->created_at = Date::now();
            $pemesananDetail->updated_at = Date::now();
            $pemesananDetail->save();

            return redirect()->route('pemesanan-barang-jadi.form-ubah', $id_pesanan)->with('success', "Berhasil menambahkan barang");
        }
    }

    public function hapusPemesanan($id_pesanan)
    {
        $pemesanan = PemesananBarangJadi::where('id', $id_pesanan)->first();
        $pemesanan->delete();

        return redirect()->route('pemesanan-barang-jadi.show')->with('success', "Berhasil menghapus pesanan");
    }

    public function hapusDetail($id_detail)
    {
        $pemesananDetail = PemesananBarangJadiDetail::where('id', $id_detail)->first();
        $pemesananDetail->delete();

        return redirect()->route('pemesanan-barang-jadi.form-ubah', $pemesananDetail->pemesanan_id)->with('success', "Berhasil menghapus barang");
    }

    public function hitung($id_pesanan)
    {
        // Ambil data pesanan
        $pesanan = PemesananBarangJadi::where('id', $id_pesanan)->first();
        $pemesanan_detail = $pesanan->pemesanan_detail;
        $total_bahan_baku = [];

        // Loop setiap detail pesanan
        foreach ($pemesanan_detail as $detail) {
            $barang_jadi_id = $detail->barang_jadi_id;
            $jumlah_pesanan = $detail->jumlah;

            // Ambil kebutuhan bahan untuk barang jadi ini
            $kebutuhan_barang = KebutuhanBarangJadi::where('barang_jadi_id', $barang_jadi_id)->get();

            // Hitung kebutuhan bahan untuk setiap barang
            foreach ($kebutuhan_barang as $kebutuhan) {
                $bahan_baku_id = $kebutuhan->bahan_baku_id;
                $table_source = $kebutuhan->table_source;
                $jumlah_kebutuhan = $kebutuhan->jumlah_kebutuhan;

                // Hitung total kebutuhan
                $total = $jumlah_pesanan * $jumlah_kebutuhan;

                // Jika bahan baku adalah berjenis potongan, bagi dengan angka potongan
                if ($table_source == 'potongan') {
                    $potongan = Potongan::find($bahan_baku_id);
                    if ($potongan && $potongan->angka_potong > 0) {
                        $total = ceil($total / $potongan->angka_potong);
                    }
                }
                
                // Buat key unik untuk setiap bahan baku
                $key = $table_source . '_' . $bahan_baku_id;

                // Tambahkan ke total
                if (!isset($total_bahan_baku[$key])) {
                    $total_bahan_baku[$key] = [
                        'table_source' => $table_source,
                        'bahan_baku_id' => $bahan_baku_id,
                        'total' => 0
                    ];

                    // Tambahkan detail nama bahan baku
                    if ($table_source == 'bahan_baku') {
                        $bahan = BahanBaku::find($bahan_baku_id);
                        $total_bahan_baku[$key]['nama'] = $bahan ? $bahan->nama : '';
                    } else if ($table_source == 'potongan') {
                        $potongan = Potongan::find($bahan_baku_id);
                        $total_bahan_baku[$key]['nama'] = $potongan ? $potongan->nama : '';
                    }
                }

                $total_bahan_baku[$key]['total'] += $total;
            }
        }

        // Kelompokkan hasil berdasarkan table_source
        $grouped_bahan_baku = [];
        foreach ($total_bahan_baku as $bahan) {
            $source = $bahan['table_source'];
            if (!isset($grouped_bahan_baku[$source])) {
                $grouped_bahan_baku[$source] = [];
            }
            $grouped_bahan_baku[$source][] = $bahan;
        }
        // dd($grouped_bahan_baku);

        return view('pemesanan_barang_jadi.hitung', compact('pesanan', 'grouped_bahan_baku'));
    }
}
