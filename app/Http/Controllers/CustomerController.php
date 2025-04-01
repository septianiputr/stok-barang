<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function show()
    {
        $customers = Customer::all();
        return view('customer.show', compact('customers'));
    }

    public function formTambah()
    {
        return view('customer.form_tambah');
    }

    public function tambahCustomer(Request $request)
    {
        $customer = new Customer();
        $customer->nama = $request->nama;
        $customer->email = $request->email;
        $customer->telp = $request->telp;
        $customer->alamat = $request->alamat;
        $customer->save();

        return redirect()->route('customer.show')->with('success', 'Customer berhasil ditambahkan');
    }

    public function formUbah($id)
    {
        $customer = Customer::where('id', $id)->first();
        return view('customer.form_ubah', compact('customer'));
    }

    public function ubahCustomer(Request $request, $id)
    {

        $customer = Customer::where('id', $id)->first();
        $customer->nama = $request->nama;
        $customer->email = $request->email;
        $customer->telp = $request->telp;
        $customer->alamat = $request->alamat;
        $customer->save();

        return redirect()->route('customer.show')->with('success', 'customer berhasil diubah');
    }

    public function hapusCustomer($id)
    {
        $customer = Customer::where('id', $id)->first();
        $customer->delete();

        return redirect()->route('customer.show')->with('success', 'customer berhasil dihapus');
    }
}
