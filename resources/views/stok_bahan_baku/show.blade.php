<!-- resources/views/stok-bahan-baku/index.blade.php -->
@extends('layouts.app')

@section('title', 'Stok Bahan Baku')

@section('content')

<div class="container">
    <p class="mb-3 text-right">
        {{\Carbon\Carbon::now()->translatedFormat('F Y') }}
    </p>
    <div class="row">
        <div class="col-6">
            <h2 class="mb-0 fw-bold">Stok Bahan Baku</h2>

        </div>
        <div class="col-6 d-flex justify-content-end align-items-end">
            <a href="{{route('pemesanan-bahan-baku.form-tambah')}}" class="btn btn-primary">Tambah Stok</a>
        </div>
    </div>
    <table class="table table-bordered mt-3 bg-white">
        <thead class="thead-light">
            <tr>
                <th>Kode Bahan</th>
                <th>Nama Bahan</th>
                <th>Jenis Bahan</th>
                <th>Stok Awal</th>
                <th>Bahan Masuk</th>
                <th>Bahan Keluar</th>
                <!-- <th>Minimal</th> -->
                <th>Stok Akhir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bahanBaku as $item)
            @php
            $stok = $stokBahanBaku->where('bahan_baku_id', $item->id)->first();
            @endphp
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jenis }}</td>
                <td>{{ $stok ? $stok->stok_awal : 0}}</td>
                <td>{{ $stok ? $stok->jumlah_masuk : 0 }}</td>
                <td>{{ $stok ? $stok->jumlah_keluar : 0 }}</td>
                <td>{{ $stok ? $stok->stok_awal + $stok->jumlah_masuk - $stok->jumlah_keluar : 0 }}</td>
                <td><a href="{{route('bahan-baku-keluar.form-tambah', $item->id)}}" class="btn btn-info btn-sm mr-2">Ambil</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection