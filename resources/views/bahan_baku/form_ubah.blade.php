@extends('layouts.app')

@section('content')
<div class="container">
    <div class="p-4 mx-auto col-6 bg-white">

        <div class="mb-4">
            <h2 class="fw-bold">Ubah Data Bahan Baku</h2>
        </div>

        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('bahan-baku.ubah', $bahan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="kode_bahan">Kode Bahan</label>
                <input type="text" name="id" id="kode_bahan" class="form-control" value="{{$bahan->id}}" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ $bahan->nama }}" required>
            </div>

            <div class="form-group">
                <label for="jenis">Jenis</label>
                <select name="jenis" id="jenis" class="form-control" required>
                    <option value="plendes" @selected($bahan->jenis == "plendes")>Plendes</option>
                    <option value="pipa" @selected($bahan->jenis == "pipa")>Pipa</option>
                    <option value="pipa" @selected($bahan->jenis == "plat")>Plat</option>
                    <option value="pureng" @selected($bahan->jenis == "pureng")>Pureng</option>
                    <option value="sensor" @selected($bahan->jenis == "sensor")>Sensor</option>
                    <option value="habis-pakai" @selected($bahan->jenis == "habis-pakai")>Habis Pakai</option>

                </select>
            </div>

            <div class="form-group">
                <label for="minimal">Minimal</label>
                <input type="number" name="minimal" id="minimal" class="form-control" value="{{ $bahan->minimal }}" required>
            </div>

            <button type="submit" class="btn btn-success mt-3 mr-2">Simpan</button>
            <a href="{{route('bahan-baku.show')}}" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
</div>

@endsection