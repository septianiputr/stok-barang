@extends('layouts.app')

@section('content')
<div class="container">
    <div class="p-4 mx-auto col-6 bg-white">

        <div class="mb-4">
            <h2 class="fw-bold">Tambah Data Bahan Baku</h2>
        </div>

        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('bahan-baku.tambah') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="kode_bahan">Kode Bahan</label>
                <input type="text" name="id" id="kode_bahan" class="form-control" value="{{ old('id') }}" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>

            <div class="form-group">
                <label for="jenis">Jenis</label>
                <select name="jenis" id="jenis" class="form-control" required>
                    <option value="plendes">Plendes</option>
                    <option value="pipa">Pipa</option>
                    <option value="pureng">Plat</option>
                    <option value="pureng">Pureng</option>
                    <option value="sensor">Sensor</option>
                    <option value="habis-pakai">Habis Pakai</option>
                </select>
            </div>

            <div class="form-group">
                <label for="minimal">Minimal</label>
                <input type="number" name="minimal" id="minimal" class="form-control" value="{{ old('minimal') }}" required>
            </div>

            <button type="submit" class="btn btn-success mt-3 mr-2">Simpan</button>
            <a href="{{route('bahan-baku.show')}}" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
</div>

@endsection