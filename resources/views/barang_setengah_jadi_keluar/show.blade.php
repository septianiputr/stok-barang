@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-6">
            <h2 class="mb-0 fw-bold">Riwayat Barang Setengah Jadi Keluar</h2>
        </div>
    </div>

    <table class="table table-bordered mt-3 bg-white">
        <thead class="thead-light">
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Tanggal Keluar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangKeluar as $barang)
            <tr>
                <td>{{ $barang->brg_setengah_jadi->id }}</td>
                <td>{{ $barang->brg_setengah_jadi->nama }}</td>
                <td>{{ $barang->jumlah }}</td>
                <td>{{ $barang->keterangan }}</td>
                <td>{{ \Carbon\Carbon::parse($barang->created_at)->translatedFormat('d F Y') }}</td>
                <td>
                    <a href="{{route('barang-setengah-jadi-keluar.form-ubah', $barang->id)}}" class="btn btn-warning btn-sm mr-2">Edit</a>
                    <form action="{{route('barang-setengah-jadi-keluar.hapus', $barang->id)}}" method="POST" style="display: inline-block;">
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
        {{ $barangKeluar->links() }}
    </div>
</div>
@endsection