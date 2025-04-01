@extends('layouts.app')

@section('content')
<div class="container">
    <div class="p-4 mx-auto col-6 bg-white">
        <div class="mb-4">
            <h2 class="fw-bold">Edit User</h2>
        </div>

        <form action="{{ route('manager_user.ubah', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group d-flex flex-column">
                <label for="role">Role :</label>
                <select name="role" id="role" class="form-control">
                    <option value="admin" {{ $user->role == "admin" ? 'selected' : '' }}>Admin</option>
                    <option value="manager" {{ $user->role == "manager" ? 'selected' : '' }}>Manager</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success mr-2">Simpan</button>
            <a href="{{ route('manager.show') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection