@extends('layouts.app')

@section('content')
<div class="container">
    <div class="p-4 mx-auto col-6 bg-white">

        <div class="mb-4">
            <h2 class="fw-bold">Ubah Data Barang Setengah Jadi</h2>
        </div>

        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('barang-setengah-jadi.ubah', $barangSetengahJadi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="kode_bahan">Kode Bahan</label>
                <input type="text" name="id" id="kode_bahan" class="form-control" value="{{$barangSetengahJadi->id}}" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ $barangSetengahJadi->nama }}" required>
            </div>

            <button type="submit" class="btn btn-success mt-3 mr-2">Simpan</button>
            <a href="{{route('barang-setengah-jadi.show')}}" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
</div>

@endsection