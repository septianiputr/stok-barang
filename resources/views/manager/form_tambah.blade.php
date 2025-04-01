@extends('layouts.app')

@section('content')

<div class="bg-white p-4" style="width: max-content;">

    <div class="mb-4">
        <h2 class="fw-bold">Buat User</h2>
    </div>
    <form action="{{ route('manager_user.tambah') }}" method="POST">
        @csrf

        <div class="d-flex" style="gap: 10px;">
            <div class="form-group d-flex flex-column">
                <label for="name">Nama :</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>

            <div class="form-group d-flex flex-column">
                <label for="username">Username :</label>
                <input type="text" id="username" name="username" class="form-control">
            </div>
        </div>

        <div class="d-flex" style="gap: 10px;">
            <div class="form-group d-flex flex-column">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" class="form-control">
            </div>

            <div class="form-group d-flex flex-column">
                <label for="password">Password :</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
        </div>

        <div class="form-group d-flex flex-column">
            <label for="role">Role :</label>
            <select name="role" id="role" class="form-control">
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <a href="{{route('manager.show')}}" class="btn btn-secondary">kembali</a>
    </form>
</div>
@endsection