@extends('layouts.app')

@section('content')
<div class="container">
    <div class="p-4 mx-auto col-6 bg-white">

        <div class="mb-4">
            <h2 class="fw-bold">Ubah Data Barang Jadi</h2>
        </div>

        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('potongan.ubah', $potongan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="bahan_baku_id">Bahan Dasar</label>
                <select name="bahan_baku_id" id="bahan_baku_id" class="form-control" required>
                    @foreach($bahanBaku as $bahan)
                    <option value="{{ $bahan->id }}" @selected($potongan->bahan_baku_id == $bahan->id)>{{ $bahan->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ $potongan->nama }}" required>
            </div>

            <div class="form-group">
                <label for="angka_potong">Angka Potong</label>
                <input type="number" name="angka_potong" id="angka_potong" class="form-control" value="{{ $potongan->angka_potong }}" required>
            </div>

            <button type="submit" class="btn btn-success mt-2 mr-2">Simpan</button>
            <a href="{{route('potongan.show')}}" class="btn btn-secondary mt-2">Kembali</a>
        </form>
    </div>
</div>

@endsection