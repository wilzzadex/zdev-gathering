<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Event Gathering</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        @media print {
            @page {
                size: auto;
                margin-top: 0;
                margin-bottom: 0px;
            }

            #data,
            #data th,
            #data td {
                border: 1px solid;
            }

            #data td,
            #data th {
                padding: 5px;
            }

            #data {
                border-spacing: 0px;
                margin-top: 40px;
                font-size: 17px;
            }

            #childTable {
                border: none;
            }

            body {
                padding-top: 10px;
                font-family: sans-serif;
            }
        }

    </style>
</head>

<body onload="window.print()">
    <table border="0" style="width: 100%;margin-top:20px">
        <tr>
            <td style="width: 70%">
                <h5><b>Nama Aplikasinya</b></h5>
            </td>
            <td rowspan="2" class="text-right"><img width="25%" src="{{ url('assets/glu.png') }}" alt=""></td>
        </tr>
        <tr>
            <td><span>alamatnya nanti disini</span></td>
        </tr>
    </table>
    <hr>
    <center> <h5><b> Laporan Periode {{ $periode }}</h5> </b> </center>
    <table id="data" style="width:100%">
        <tr>
            <th class="text-center">NO.</th>
            <th class="text-center">KODE EVENT</th>
            <th class="text-center">NAMA KLIEN</th>
            <th class="text-center">LOKASI</th>
            {{-- <th class="text-center">TANGGAL BOOKING</th> --}}
            <th class="text-center">TANGGAL ACARA</th>
            <th class="text-center">STATUS</th>
            <th class="text-center">BUDGET</th>
        </tr>
        @php
            $gt = 0;
        @endphp
        @foreach ($event as $key => $item)
            <tr>
                <td class="text-center">{{ $key+1 }}</td>
                <td class="text-center">{{ $item->kode_event }}</td>
                <td class="text-center">{{ $item->nama_klien }}</td>
                <td class="text-center">{{ $item->lokasi->nama }}</td>
                <td class="text-center">{{ date('d M Y',strtotime($item->tanggal_mulai)) }} s/d {{ date('d M Y',strtotime($item->tanggal_selesai)) }} ({{ $item->total_hari }} Hari)</td>
                <td class="text-center">{{ $item->status == 'lunas' ? 'Lunas' : 'Menunggu Pembayaran' }}</td>
                <td class="text-center">{{ number_format($item->total_budget) }}</td>
            </tr>
        @endforeach
        {{-- @foreach ($penjualan as $key => $item)
        @php
            $gt += $item->total_harga;
        @endphp
            <tr>
                <td class="text-center">{{ $key+1 }}</td>
                <td class="text-center">{{ $item->kode_transaksi }}</td>
                <td class="text-center">{{ date('d M Y H:i',strtotime($item->created_at)) }}</td>
                <td class="text-center">{{ $item->pelanggan->nama }}</td>
                <td class="text-center">{{ number_format($item->total_harga) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3"><b> Grand Total </b></td>
            <td colspan="2" class="text-center"><b>Rp.  {{ number_format($gt) }} </b></td>
        </tr> --}}
    </table>
</body>

</html>
