@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-6">
            <h2 class="mb-0 fw-bold">Data Bahan Baku</h2>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-end">
            <a href="{{ route('bahan-baku.form-tambah') }}" class="btn btn-primary">Tambah Data</a>

        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered bg-white">
        <thead class="thead-light">
            <tr>
                <th>Kode Bahan</th>
                <th>Nama Bahan</th>
                <th>Jenis</th>
                <th>Minimal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bahanBaku as $bahanBaku)
            <tr>
                <td>{{ $bahanBaku->id }}</td>
                <td>{{ $bahanBaku->nama }}</td>
                <td>{{ $bahanBaku->jenis }}</td>
                <td>{{ $bahanBaku->minimal }}</td>
                <td class="col-2">
                    <a href="{{ route('bahan-baku.form-ubah', $bahanBaku->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('bahan-baku.hapus', $bahanBaku->id) }}" method="POST" class="d-inline">
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