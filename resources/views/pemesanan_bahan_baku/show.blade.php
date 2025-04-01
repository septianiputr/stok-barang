@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-6">
            <h2 class="mb-0 fw-bold">Riwayat Pemesanan Bahan Baku</h2>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-end">
            <a href="{{route('pemesanan-bahan-baku.form-tambah')}}" class="btn btn-primary">Pesan Bahan Baku</a>
        </div>
    </div>

    <table class="table table-bordered mt-3 bg-white">
        <thead class="thead-light">
            <tr>
                <th>Kode Bahan</th>
                <th>Nama Bahan</th>
                <th>Jenis Bahan</th>
                <th>Jumlah</th>
                <th>Tanggal Pemesanan</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemesananBahanBaku as $pemesanan)
            <tr>
                <td>{{ $pemesanan->bahan_baku->id }}</td>
                <td>{{ $pemesanan->bahan_baku->nama }}</td>
                <td>{{ $pemesanan->bahan_baku->jenis }}</td>
                <td>{{ $pemesanan->jumlah }}</td>
                <td>{{ \Carbon\Carbon::parse($pemesanan->created_at)->translatedFormat('d F Y') }}</td>
                <td>{{ $pemesanan->keterangan }}</td>
                <td>
                    <a href="{{route('pemesanan-bahan-baku.form-edit', $pemesanan->id)}}" class="btn btn-warning btn-sm mr-2">Edit</a>
                    <form action="{{route('pemesanan-bahan-baku.delete', $pemesanan->id)}}" method="POST" style="display: inline-block;">
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
        {{ $pemesananBahanBaku->links() }}
    </div>
</div>
@endsection