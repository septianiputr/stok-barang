@extends('layouts.app')

@section('content')
<div class="container">
    <div class="p-4 mx-auto col-7 bg-white">

        <div class="mb-4">
            <h2 class="fw-bold">Form Pemesanan Barang Jadi</h2>
        </div>

        <form action="{{ route('pemesanan-barang-jadi.tambah') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_pemesan">Nama Pemesan</label>
                <select name="customer_id" id="customer_id" class="form-control" required>
                    @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div id="pemesanan-items">
                <div class="pemesanan-item d-flex">
                    <div class="form-group col-8 px-0">
                        <label for="nama_barang">Nama Barang</label>
                        <select name="kode_barang" class="form-control" required>
                            @foreach($barangJadi as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-4">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" min="1" required>
                    </div>
                </div>
            </div>

            <button type="submit" id="add-item" class="btn btn-primary mr-2">Buat Pesanan</button>
            <button type="reset" class="btn btn-danger mr-2">Cancel</button>
        </form>
    </div>
</div>

@endsection