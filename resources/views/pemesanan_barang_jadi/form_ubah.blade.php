@extends('layouts.app')

@section('content')

<div class="container">
    <div class="p-4 mx-auto col-7 bg-white">

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-4">
            <h2 class="fw-bold">Form Pemesanan Barang Jadi</h2>
        </div>

        <form action="{{ route('pemesanan-barang-jadi.ubah', $pemesanan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_pemesan">Nama Pemesan</label>
                <select name="customer_id" id="customer_id" class="form-control" required>
                    @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" @selected($customer->id == $pemesanan->customer->id)>{{ $customer->nama }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" id="add-item" class="btn btn-primary mr-2">Simpan</button>
            <a href="{{route('pemesanan-barang-jadi.show')}}" type="reset" class="btn btn-danger">Kembali</a>
        </form>
    </div>

    <div class="p-4 mx-auto col-7 bg-white mt-4">
        <form action="{{route('pemesanan-barang-jadi.ubah', $pemesanan->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div id="pemesanan-items">
                <div class="pemesanan-item d-flex align-items-end">
                    <div class="form-group col-6 px-0 mb-0">
                        <label for="nama_barang">Nama Barang</label>
                        <select name="kode_barang" class="form-control" required>
                            @foreach($barangJadi as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-4 mb-0">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" min="1" required>
                    </div>
                    <button type="submit" id="add-item" class="btn btn-info col-2" style="height: max-content;">Tambah</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered bg-white mt-4">
            <thead class="thead-light">
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemesanan->pemesanan_detail as $detail)
                <tr>
                    <td>{{ $detail->barang_jadi->id }}</td>
                    <td>{{ $detail->barang_jadi->nama }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td class="col-2">
                        <form action="{{route('detail-pemesanan-barang-jadi.hapus', $detail->id)}}" method="POST" class="d-inline">
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