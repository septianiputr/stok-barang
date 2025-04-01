<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;
use App\Models\User;

class ManagerController extends Controller
{
    public function show()
    {
        $users = User::all();
        return view('manager.show', compact('users'));
    }

    public function formTambah()
    {
        return view('manager.form_tambah');
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,manager',
            'password' => 'required|string|min:8',
        ]);

        $userData = $request->only(['username', 'email', 'role', "name", "password"]);

        User::create($userData);

        return redirect()->route('manager.show')->with('success', 'Data berhasil ditambahkan.');
    }

    public function formUbah($id)
    {
        $user = User::findOrFail($id);
        return view('manager.form_ubah', compact('user'));
    }

    public function ubah(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,manager',
        ]);

        // Update data user
        $user->username = $request->nama;
        $user->name = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;

        // Jika password diisi, update password baru
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('manager.show')->with('success', 'User berhasil diupdate.');
    }

    public function hapus($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('manager.show')->with('success', 'User berhasil dihapus.');
    }
}
