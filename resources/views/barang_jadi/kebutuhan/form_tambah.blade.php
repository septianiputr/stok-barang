@extends('layouts.app')

@section('content')

<div class="container">
    <div class="p-4 mx-auto col-6 bg-white">

        <div class="mb-4">
            <h2 class="fw-bold">Tambah Kebutuhan barang {{$barangJadi->nama}}</h2>
        </div>

        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('barang-jadi.kebutuhan_tambah', $barangJadi->id) }}" method="POST">
            @csrf

            <input type="hidden" name="barang_jadi_id" value="{{$barangJadi->id}}">
            <div class="form-group">
                <label for="bahan_baku_id">Bahan Baku</label>
                <select name="bahan_baku_id" id="bahan_baku_id" class="form-control" required>
                    @foreach($bahanBaku as $bahan)
                    <option value="{{ $bahan->id }}" data-jenis="{{ $bahan->jenis }}">{{ $bahan->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" id="potongan-group">
                <label for="potongan_id">Potongan</label>
                <select name="potongan_id" id="potongan_id" class="form-control">
                    @foreach($potongan as $potongan)
                    <option value="{{ $potongan->id }}" data-bahan-baku-id="{{ $potongan->bahan_baku_id }}">{{ $potongan->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="jumlah_potongan">Jumlah</label>
                <input id="jumlah_potongan" type="number" name="jumlah" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('bahan_baku_id').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var jenis = selectedOption.getAttribute('data-jenis');
        var potonganGroup = document.getElementById('potongan-group');
        var potonganSelect = document.getElementById('potongan_id');
        var selectedBahanBakuId = this.value;

        if (jenis !== 'pipa') {
            potonganGroup.style.display = 'none';
            potonganSelect.removeAttribute('required');
        } else {
            potonganGroup.style.display = 'block';
            potonganSelect.setAttribute('required', 'required');
        }

        // Filter potongan options
        for (var i = 0; i < potonganSelect.options.length; i++) {
            var option = potonganSelect.options[i];
            if (option.getAttribute('data-bahan-baku-id') === selectedBahanBakuId) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        }

        // Reset the selected option
        potonganSelect.selectedIndex = -1;
    });

    // Trigger change event on page load to set initial state
    document.getElementById('bahan_baku_id').dispatchEvent(new Event('change'));
</script>

@endsection