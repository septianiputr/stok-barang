@extends('layouts.app')

@section('content')

<div class="container">


    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row mb-4">
        <div class="col-6">
            <h2 class="mb-0 fw-bold">Data User</h2>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-end">
            <a href="{{ route('manager_user.form-tambah') }}" class="btn btn-primary">Tambah Data</a>
        </div>
    </div>

    <table class="table table-bordered bg-white">
        <thead class="thead-light">
            <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('manager_user.form-ubah', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('manager_user.hapus', $user->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection