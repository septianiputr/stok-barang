@extends('layouts.app')

@section('content')
<div class="container">
    <div class="p-4 mx-auto col-7 bg-white">

        <div class="mb-4">
            <h2 class="fw-bold">Ubah Data Barang Jadi</h2>
        </div>

        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('barang-jadi.ubah', $barangJadi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="kode_bahan">Kode Bahan</label>
                <input type="text" name="id" id="kode_bahan" class="form-control" value="{{$barangJadi->id}}" required readonly>
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ $barangJadi->nama }}" required>
            </div>

            <button type="submit" class="btn btn-success mt-2 mr-2">Simpan</button>
            <a href="{{route('barang-jadi.show')}}" class="btn btn-secondary mt-2">Kembali</a>
        </form>
    </div>

    <div class="p-4 mx-auto col-7 bg-white mt-4">
        <div class="form-group d-flex justify-content-between mt-4 align-items-center">
            <h2 class="fw-bold">Kebutuhan Bahan</h2>
            <a href="{{ route('barang-jadi.kebutuhan_form', $barangJadi->id) }}" class="btn btn-primary">Tambah Bahan</a>
        </div>
        <table class="table table-bordered bg-white">
            <thead class="thead-light">
                <tr>
                    <th>Nama Bahan</th>
                    <th>Jumlah Kebutuhan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kebutuhanBarangJadi as $kebutuhan)
                <tr>
                    <td>{{ $kebutuhan->bahan_baku->nama }}</td>
                    <td>{{ $kebutuhan->jumlah_kebutuhan }}</td>
                    <td class="col-2">
                        <form action="{{ route('barang-jadi.kebutuhan_hapus', ['id' => $barangJadi->id, 'kebutuhan_id' => $kebutuhan->id]) }}" method="POST" class="d-inline">
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
</div>

@endsection