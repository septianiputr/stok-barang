@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-6">
            <h2 class="mb-0 fw-bold">Riwayat Bahan Baku Keluar</h2>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered bg-white">
        <thead class="thead-light">
            <tr>
                <th>Kode Bahan</th>
                <th>Nama Bahan</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bahanBakuKeluar as $bahan)
            <tr>
                <td>{{ $bahan->bahan_baku->id }}</td>
                <td>{{ $bahan->bahan_baku->nama }}</td>
                <td>{{ $bahan->jumlah }}</td>
                <td>{{ $bahan->keterangan }}</td>
                <td>{{ \Carbon\Carbon::parse($bahan->created_at)->translatedFormat('d F Y') }}</td>
                <td>
                    <a href="{{ route('bahan-baku-keluar.form-ubah', $bahan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('bahan-baku-keluar.hapus', $bahan->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $bahanBakuKeluar->links() }}
    </div>
</div>
@endsection