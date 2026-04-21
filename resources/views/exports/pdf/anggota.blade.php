@extends('exports.pdf.layout')

@section('content')
    <p style="margin-bottom: 12px;">Jumlah data: <strong>{{ $items->count() }}</strong> anggota</p>

    <table>
        <thead>
            <tr>
                <th style="width:30px;">No</th>
                <th>NIS/NIP</th>
                <th>Nama Lengkap</th>
                <th style="width:70px;">Peran</th>
                <th style="width:70px;">Kelas</th>
                <th>Alamat</th>
                <th>No HP</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $i => $anggota)
            <tr>
                <td style="text-align:center;">{{ $i + 1 }}</td>
                <td>{{ $anggota->nis_nip }}</td>
                <td>{{ $anggota->user?->name ?? '-' }}</td>
                <td>{{ ucfirst($anggota->user?->role ?? '-') }}</td>
                <td>{{ $anggota->kelas ?? '-' }}</td>
                <td>{{ $anggota->alamat ?? '-' }}</td>
                <td>{{ $anggota->no_hp ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
