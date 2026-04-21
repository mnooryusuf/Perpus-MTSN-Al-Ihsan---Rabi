@extends('exports.pdf.layout')

@section('content')
    <p style="margin-bottom: 12px;">
        Periode: <strong>{{ \Carbon\Carbon::parse($start)->format('d M Y') }}</strong>
        s/d <strong>{{ \Carbon\Carbon::parse($end)->format('d M Y') }}</strong>
        — Jumlah data: <strong>{{ $items->count() }}</strong> transaksi
    </p>

    <table>
        <thead>
            <tr>
                <th style="width:30px;">No</th>
                <th>NIS/NIP</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th style="width:80px;">Tgl Pinjam</th>
                <th style="width:90px;">Tgl Dikembalikan</th>
                <th style="width:80px;">Denda</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $i => $t)
            <tr>
                <td style="text-align:center;">{{ $i + 1 }}</td>
                <td>{{ $t->anggota?->nis_nip ?? '-' }}</td>
                <td>{{ $t->anggota?->user?->name ?? '-' }}</td>
                <td>{{ $t->buku?->judul ?? '-' }}</td>
                <td>{{ $t->tanggal_pinjam }}</td>
                <td>{{ $t->tanggal_dikembalikan }}</td>
                <td style="text-align:right;">{{ $t->denda > 0 ? 'Rp ' . number_format($t->denda, 0, ',', '.') : '-' }}</td>
            </tr>
            @endforeach
            @if($items->sum('denda') > 0)
            <tr class="total-row">
                <td colspan="6" style="text-align:right;">Total Denda:</td>
                <td style="text-align:right;">Rp {{ number_format($items->sum('denda'), 0, ',', '.') }}</td>
            </tr>
            @endif
        </tbody>
    </table>
@endsection
