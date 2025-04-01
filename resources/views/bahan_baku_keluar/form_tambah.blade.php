@extends('layouts.app')

@section('content')
<div class="container">
    <div class="p-4 mx-auto col-6 bg-white">
        <h2 class="mb-4 fw-bold">Ambil bahan baku dari stok</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('bahan-baku-keluar.tambah', $bahanBaku->id) }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="kode_bahan">Kode Bahan</label>
                <input type="text" name="kode_bahan" id="kode_bahan" class="form-control" value="{{ $bahanBaku->id}}" required readonly>
            </div>

            <div class="form-group">
                <label for="">Nama Bahan</label>
                <input type="text" name="" id="" class="form-control" value="{{ $bahanBaku->nama}}" required readonly>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" value="" required>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control" value="" required>
            </div>

            <div class="form-group">
                <label for="created_at">Tanggal Keluar</label>
                <input type="date" name="created_at" id="created_at" class="form-control" value="" required>
            </div>

            <button type="submit" class="btn btn-success mr-2">Simpan</button>
            <a href="{{ route('stok-bahan-baku.show') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

@endsection