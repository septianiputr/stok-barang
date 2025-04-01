@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-6">
            <h2 class="mb-0 fw-bold">Data Customer</h2>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-end">
            <a href="{{ route('customer.form-tambah') }}" class="btn btn-primary">Tambah Data</a>

        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered bg-white">
        <thead class="thead-light">
            <tr>
                <th>Nama</th>
                <th>Nama Email</th>
                <th>No Tep</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->nama }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->telp }}</td>
                <td>{{ $customer->alamat }}</td>
                <td class="col-2">
                    <a href="{{ route('customer.form-ubah', $customer->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('customer.hapus', $customer->id) }}" method="POST" class="d-inline">
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