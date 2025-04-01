@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h2 class="mb-0 fw-bold">Daftar Pemesanan Knalpot</h2>
    <div class="container row">
        <form action="" method="GET" class="col-md-6 mt-4">
            <label for="tahun">Filter Berdasarkan Tahun:</label>
            <div class="row">
                <div class="col-md-6">
                    <select name="tahun" id="tahun" class="form-control">
                        <option value="">Pilih Tahun</option>
                        @for ($year = date('Y'); $year >= 2020; $year--)
                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
        <div class="col-md-6 d-flex justify-content-end align-items-end">
            <a href="{{route('pemesanan-barang-jadi.form-tambah')}}" class="btn btn-primary">Tambah Pesanan</a>
        </div>
    </div>

    <div class="container mt-4">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Customer</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Detail Pemesanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemesananBarangJadi as $pemesanan)
                <tr>
                    <td>{{ $pemesanan->customer->nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($pemesanan->created_at)->translatedFormat('d F Y') }}</td>
                    <td class="p-0 col-5">
                        <table class="table table-sm table-bordered">
                            <tbody>
                                @foreach($pemesanan->pemesanan_detail as $detail)
                                <tr>
                                    <td>{{ $detail->barang_jadi->nama }} </td>
                                    <td>{{ $detail->jumlah }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <form action="{{route('pemesanan-barang-jadi.hapus', $pemesanan->id)}}" method="POST" class="d-flex">
                            @csrf
                            @method('DELETE')
                            <a href="{{route('pemesanan-barang-jadi.hitung', $pemesanan->id)}}" class="btn btn-info btn-sm mr-2">Hitung</a>
                            <a href="{{route('pemesanan-barang-jadi.form-ubah', $pemesanan->id)}}" class="btn btn-warning btn-sm mr-2">Edit</a>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $pemesananBarangJadi->links() }}
        </div>
    </div>
</div>
@endsection