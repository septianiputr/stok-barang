@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <h2 class="mb-3">Hasil Perhitungan Kebutuhan Bahan</h2>
        <a class="btn btn-primary" href="{{route('pemesanan-barang-jadi.show')}}" style="height: max-content;">Kembali</a>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <h5>Pesanan #{{$pesanan->customer->nama}}</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Total Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pesanan->pemesanan_detail as $detail)
                    <tr>
                        <td>{{ $detail->barang_jadi->id }}</td>
                        <td>{{ $detail->barang_jadi->nama }}</td>
                        <td>{{ $detail->jumlah }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex">
        @foreach($grouped_bahan_baku as $source => $bahan_list)
        <div class="card mb-3 col-6">
            <div class="card-header">
                <h5>{{ ucfirst($source) }}</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Total Kebutuhan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bahan_list as $bahan)
                        <tr>
                            <td>{{ $bahan['nama'] }}</td>
                            <td>{{ $bahan['total'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection