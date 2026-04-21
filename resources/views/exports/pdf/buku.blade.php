@extends('exports.pdf.layout')

@section('content')
    <p style="margin-bottom: 12px;">Jumlah data: <strong>{{ $items->count() }}</strong> buku</p>

    <table>
        <thead>
            <tr>
                <th style="width:30px;">No</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th style="width:60px;">Tahun</th>
                <th>Kategori</th>
                <th style="width:60px;">Eksemplar</th>
                <th style="width:60px;">Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $i => $buku)
            <tr>
                <td style="text-align:center;">{{ $i + 1 }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ $buku->penerbit }}</td>
                <td style="text-align:center;">{{ $buku->tahun_terbit }}</td>
                <td>{{ $buku->kategori }}</td>
                <td style="text-align:center;">{{ $buku->jumlah_eksemplar }}</td>
                <td style="text-align:center;">{{ $buku->available_stock }}</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="6" style="text-align:right;">Total Eksemplar:</td>
                <td style="text-align:center;">{{ $items->sum('jumlah_eksemplar') }}</td>
                <td style="text-align:center;">{{ $items->sum(fn($b) => $b->available_stock) }}</td>
            </tr>
        </tbody>
    </table>
@endsection
