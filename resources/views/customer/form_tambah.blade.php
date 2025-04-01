@extends('layouts.app')

@section('content')
<div class="container">
    <div class="p-4 mx-auto col-6 bg-white">

        <div class="mb-4">
            <h2 class="fw-bold">Tambah Data Customer</h2>
        </div>

        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('customer.tambah') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="telp">Telp</label>
                <input type="text" name="telp" id="telp" class="form-control" value="{{ old('nama') }}" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" value="{{ old('alamat') }}" required>
            </div>

            <button type="submit" class="btn btn-success mt-3 mr-2">Simpan</button>
            <a href="{{route('customer.show')}}" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
</div>

@endsection