@extends('layouts.app')

@section('content')
<div class="container">
    <div class="p-4 mx-auto col-6 bg-white">

        <div class="mb-4">
            <h2 class="fw-bold">Ubah Riwayat Keluar</h2>
        </div>

        <form action="{{ route('barang-jadi-keluar.ubah', $barangKeluar->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" name="kode_barang" id="kode_barang" class="form-control" value="{{ $barangKeluar->barang_jadi->id}}" required readonly>
            </div>

            <div class="form-group">
                <label for="">Nama Barang</label>
                <input type="text" name="" id="" class="form-control" value="{{ $barangKeluar->barang_jadi->nama}}" required readonly>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ $barangKeluar->jumlah }}" required>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control" value="{{ $barangKeluar->keterangan }}" required>
            </div>

            <div class="form-group">
                <label for="created_at">Tanggal Keluar</label>
                <input type="date" name="created_at" id="created_at" class="form-control" value="{{ $barangKeluar->created_at->format('Y-m-d') }}" required readonly>
            </div>


            <!-- <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control" value="{{ $barangKeluar->harga }}" required>
            </div> -->

            <button type="submit" class="btn btn-success mt-2 mr-2">Simpan Perubahan</button>
            <a href="{{ route('barang-jadi-keluar.show') }}" class="btn btn-secondary mt-2">Kembali</a>
        </form>
    </div>
</div>
@endsection