@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-6">
            <h2 class="mb-0 fw-bold">Data Potongan</h2>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-end">
            <a href="{{ route('potongan.form-tambah') }}" class="btn btn-primary">Tambah Data</a>

        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered bg-white">
        <thead class="thead-light">
            <tr>
                <th>Bahan Dasar</th>
                <th>Nama Potongan</th>
                <th>Angka Potong</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($potongan as $potongan)
            <tr>
                <td>{{ $potongan->bahan_baku->nama }}</td>
                <td>{{ $potongan->nama }}</td>
                <td>{{ $potongan->angka_potong }}</td>
                <td class="col-2">
                    <a href="{{ route('potongan.form-ubah', $potongan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('potongan.hapus', $potongan->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection