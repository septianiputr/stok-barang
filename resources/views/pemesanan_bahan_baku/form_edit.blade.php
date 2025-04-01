@extends('layouts.app')

@section('content')
<div class="container">
    <div class="p-4 mx-auto col-6 bg-white">

        <div class="mb-4">
            <h2 class="fw-bold">Ubah Pemesanan Bahan Baku</h2>
        </div>

        <form action="{{ route('pemesanan-bahan-baku.update', $pemesanan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="kode_bahan">Bahan Baku</label>
                <select name="kode_bahan" id="kode_bahan" class="form-control" required>
                    <option value="{{ $pemesanan->bahan_baku->id }}"> {{ $pemesanan->bahan_baku->nama }} - {{ $pemesanan->bahan_baku->id }}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ $pemesanan->jumlah }}" required>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control" value="{{ $pemesanan->keterangan }}" required>
            </div>

            <div class="form-group">
                <label for="created_at">Tanggal Pemesanan</label>
                <input type="date" name="created_at" id="created_at" class="form-control" value="{{ $pemesanan->created_at->format('Y-m-d') }}" required readonly>
            </div>

            <!-- <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control" value="{{ $pemesanan->harga }}" required>
            </div> -->

            <button type="submit" class="btn btn-success mt-3 mr-2">Simpan Perubahan</button>
            <a href="{{ route('pemesanan-bahan-baku.show') }}" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
</div>
@endsection