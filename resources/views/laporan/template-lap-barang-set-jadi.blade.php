<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Stok Barang Setengah Jadi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }

        .header h3 {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: .2rem;
            margin-top: 0rem;
        }

        .sub-header {
            font-size: 14px;
            margin-top: 0.3rem;
        }

        .report-info {
            display: flex;
            text-align: left;
            flex-direction: column;
            margin-bottom: 10px;
            flex-grow: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="header">
        <h3> CV KARYA SINAR TERANG </h3>
        <p class="sub-header">Jl. Kopral Tanwir, Brubahan, Purbalingga Lor Jawa tengah 53311</p>
    </div>

    <div class="container">
        <h4>Laporan Stok Barang Setengah Jadi</h4>
    </div>

    <div class="report-info">
        <strong>Bulan:</strong> {{$bulan_tahun}}
    </div>


    <table class="table table-bordered mt-3 bg-white">
        <thead class="thead-light">
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Stok Awal</th>
                <th>Barang Masuk</th>
                <th>Barang Keluar</th>
                <th>Stok Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangSetengahJadi as $item)\
            @php
            $stok = $stokBarangSetengahJadi->where('brg_setengah_jadi_id', $item->id)->first();
            @endphp
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jenis }}</td>
                <td>{{ $stok ? $stok->stok_awal : 0}}</td>
                <td>{{ $stok ? $stok->jumlah_masuk : 0 }}</td>
                <td>{{ $stok ? $stok->jumlah_keluar : 0 }}</td>
                <td>{{ $stok ? $stok->stok_awal + $stok->jumlah_masuk - $stok->jumlah_keluar : 0 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>