@extends('layouts.app')

@section('content')
<div class="container">
    <div class="p-4 mx-auto col-6 bg-white">

        <div class="mb-4">
            <h2 class="fw-bold">Tambah Pemesanan Bahan Baku</h2>
        </div>

        <form action="{{ route('pemesanan-bahan-baku.create') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="search_bahan">Cari Bahan</label>
                <input type="text" id="search_bahan" class="form-control" placeholder="Cari bahan...">
            </div>

            <div class="form-group">
                <label for="kode_bahan">Kode Bahan</label>
                <select name="kode_bahan" id="kode_bahan" class="form-control" required>
                    @foreach ($bahan_baku as $bahan_baku)
                    <option value="{{ $bahan_baku->id }}" data-nama="{{ $bahan_baku->nama }}">
                        {{ $bahan_baku->nama }} - {{ $bahan_baku->id }}
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

            <!-- <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga') }}" required>
            </div> -->

            <button type="submit" class="btn btn-success mt-2 mr-2">Simpan</button>
            <a href="{{route('pemesanan-bahan-baku.show')}}" class="btn btn-secondary mt-2">Kembali</a>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById('search_bahan');
        const kodeBarangSelect = document.getElementById('kode_bahan');

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