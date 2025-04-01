@extends('layouts.app')

@section('content')
<div class="container">
    <div class="p-4 mx-auto col-6 bg-white">
        <h2 class="mb-4 fw-bold">Ubah Riwayat Keluar</h2>

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

        <form action="{{ route('bahan-baku-keluar.ubah', $dataKeluar->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="kode_bahan">Kode Bahan</label>
                <input type="text" name="kode_bahan" id="kode_bahan" class="form-control" value="{{ $dataKeluar->bahan_baku_id}}" required readonly>
            </div>

            <div class="form-group">
                <label for="">Nama Bahan</label>
                <input type="text" name="" id="" class="form-control" value="{{ $dataKeluar->bahan_baku->nama}}" required readonly>
            </div>


            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{$dataKeluar->jumlah}}" required>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control" value="{{$dataKeluar->keterangan}}" required>
            </div>

            <div class="form-group">
                <label for="created_at">Tanggal Keluar</label>
                <input type="date" name="created_at" id="created_at" class="form-control" value="{{ $dataKeluar->created_at->format('Y-m-d') }}" required readonly>
            </div>

            <button type="submit" class="btn btn-success mt-2 mr-2">Simpan Perubahan</button>
            <a href="{{ route('bahan-baku-keluar.show') }}" class="btn btn-secondary mt-2">Kembali</a>
        </form>
    </div>
</div>

@endsection