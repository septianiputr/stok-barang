@extends('layouts.app')

@section('content')
<div class="bg-white p-4 col-3">
    <form action="{{ route('laporan.download') }}" method="GET">
        <div class="form-group d-flex flex-column">
            <label for="jenis-laporan">Pilih Jenis Laporan :</label>
            <select name="kategori" id="jenis-laporan" class="form-control">
                <option value="bahan-baku">Bahan Baku</option>
                <option value="barang-setengah-jadi">Barang Setengah Jadi</option>
                <option value="barang-jadi">Barang Jadi</option>
            </select>
        </div>

        <div class="form-group d-flex flex-column mt-3">
            <label for="bulan-tahun">Pilih Bulan dan Tahun :</label>
            <input type="month" name="bulan_tahun" id="bulan-tahun" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Unduh</button>
    </form>
</div>
@endsection