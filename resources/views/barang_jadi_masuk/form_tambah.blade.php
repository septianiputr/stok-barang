@extends('layouts.app')

@section('content')
<div class="container">
    <div class="p-4 mx-auto col-6 bg-white">

        <div class="mb-4">
            <h2 class="fw-bold">Tambah Stok Barang Jadi</h2>
        </div>

        <form action="{{ route('barang-jadi-masuk.tambah') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="search_barang">Cari Barang</label>
                <input type="text" id="search_barang" class="form-control" placeholder="Cari barang...">
            </div>

            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <select name="kode_barang" id="kode_barang" class="form-control" required>
                    @foreach ($barangJadi as $barang_jadi)
                    <option value="{{ $barang_jadi->id }}" data-nama="{{ $barang_jadi->nama }}">
                        {{ $barang_jadi->nama }} - {{ $barang_jadi->id }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ old('jumlah') }}" required>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control" value="{{ old('keterangan') }}" required>
            </div>

            <div class="form-group">
                <label for="created_at">Tanggal Pemesanan</label>
                <input type="date" name="created_at" id="created_at" class="form-control" value="{{ old('created_at') }}" required>
            </div>

            <button type="submit" class="btn btn-success mt-3 mr-2">Simpan</button>
            <a href="{{ route('barang-jadi-masuk.show') }}" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById('search_barang');
        const kodeBarangSelect = document.getElementById('kode_barang');

        searchInput.addEventListener('keyup', function() {
            const searchValue = searchInput.value.toLowerCase();
            let firstMatch = null;

            for (let i = 0; i < kodeBarangSelect.options.length; i++) {
                const option = kodeBarangSelect.options[i];
                const text = option.text.toLowerCase();

                if (text.includes(searchValue)) {
                    option.style.display = ""; // Show matching option
                    if (!firstMatch) firstMatch = option; // Select first match
                } else {
                    option.style.display = "none"; // Hide non-matching options
                }
            }

            if (firstMatch) {
                kodeBarangSelect.value = firstMatch.value;
            }
        });
    });
</script>

@endsection