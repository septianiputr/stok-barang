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
            <h2 class="mb-0 fw-bold">Stok Barang Setengah Jadi</h2>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-end">
            <a href="{{route('barang-setengah-jadi-masuk.form-tambah')}}" class="btn btn-primary">Tambah Stok</a>
        </div>
    </div>
    <table class="table table-bordered mt-3 bg-white">
        <thead class="thead-light">
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Stok Awal</th>
                <th>Barang Masuk</th>
                <th>Barang Keluar</th>
                <th>Stok Akhir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangSetengahJadi as $item)\
            @php
            $stok = $stokBarangSetengahJadi->where('brg_setengah_jadi_id', $item->id)->first();
            @endphp
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jenis }}</td>
                <td>{{ $stok ? $stok->stok_awal : 0}}</td>
                <td>{{ $stok ? $stok->jumlah_masuk : 0 }}</td>
                <td>{{ $stok ? $stok->jumlah_keluar : 0 }}</td>
                <td>{{ $stok ? $stok->stok_awal + $stok->jumlah_masuk - $stok->jumlah_keluar : 0 }}</td>
                <td><a href="{{route('barang-setengah-jadi-keluar.form-tambah', $item->id)}}" class="btn btn-info btn-sm mr-2">Ambil</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection