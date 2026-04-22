<x-filament-panels::page>
<style>
    /* ===== SCREEN STYLES ===== */

    /* ===== PRINT STYLES ===== */
    @media print {
        /* Sembunyikan semua elemen navigasi Filament */
        nav, aside, header, footer,
        .fi-sidebar,
        .fi-topbar,
        .fi-header,
        [class*="fi-sidebar"],
        [class*="fi-topbar"],
        [class*="fi-header"],
        [class*="fi-breadcrumbs"] { display: none !important; }

        /* Atur ukuran margin kertas bawaan browser agar tidak memicu halaman baru */
        @page { size: auto; margin: 5mm; }

        /* Reset layout halaman agar tidak ada margin/padding/overflow/min-height dari Filament */
        body, html { 
            margin: 0 !important; 
            padding: 0 !important; 
            background: white !important; 
            height: auto !important; 
            min-height: 0 !important;
            overflow: visible !important; 
        }
        
        /* Hapus jarak-jarak dari wrapper bawaan Filament */
        main, .fi-main, .fi-body, .fi-page, .fi-layout { 
            padding: 0 !important; 
            margin: 0 !important; 
            display: block !important; 
            height: auto !important; 
            min-height: 0 !important;
            overflow: visible !important; 
            background: white !important;
            box-shadow: none !important;
        }

        /* Sembunyikan UI web, tampilkan dokumen cetak */
        #laporan-web-ui  { display: none !important; }
        #laporan-cetak   { display: block !important; padding: 0 !important; margin: 0 !important; }

        /* Pastikan tabel tidak terpotong halaman */
        table { page-break-inside: avoid; }
        tr    { page-break-inside: avoid; }
    }
</style>

    {{-- Non-Printable UI --}}
    <div id="laporan-web-ui" style="display:flex; flex-direction:column; gap:1.5rem;">

        {{-- Stats Grid --}}
        <div style="display:grid; grid-template-columns:repeat(5,1fr); gap:1.25rem;">

            {{-- Total Buku --}}
            <div style="position:relative; overflow:hidden; padding:1.5rem; background:white; border-radius:1rem; box-shadow:0 1px 3px rgba(0,0,0,.08); border:1px solid #e5e7eb; transition:box-shadow .2s;"
                 onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,.12)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,.08)'">
                <div style="display:flex; align-items:center; gap:1rem;">
                    <div style="padding:.75rem; background:#f0fdf4; border-radius:.75rem; color:#16a34a; flex-shrink:0;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:1.5rem;height:1.5rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <div>
                        <p style="font-size:.8rem; font-weight:500; color:#6b7280; margin:0;">Total Buku</p>
                        <p style="font-size:1.75rem; font-weight:700; color:#111827; margin:0; line-height:1.2;">{{ number_format($stats['total_buku']) }}</p>
                    </div>
                </div>
                <div style="position:absolute; right:-8px; bottom:-8px; opacity:.05; color:#111827;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:4rem;height:4rem;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
            </div>

            {{-- Dipinjam --}}
            <div style="position:relative; overflow:hidden; padding:1.5rem; background:white; border-radius:1rem; box-shadow:0 1px 3px rgba(0,0,0,.08); border:1px solid #e5e7eb; transition:box-shadow .2s;"
                 onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,.12)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,.08)'">
                <div style="display:flex; align-items:center; gap:1rem;">
                    <div style="padding:.75rem; background:#eff6ff; border-radius:.75rem; color:#2563eb; flex-shrink:0;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:1.5rem;height:1.5rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                        </svg>
                    </div>
                    <div>
                        <p style="font-size:.8rem; font-weight:500; color:#6b7280; margin:0;">Dipinjam</p>
                        <p style="font-size:1.75rem; font-weight:700; color:#111827; margin:0; line-height:1.2;">{{ number_format($stats['total_pinjam']) }}</p>
                    </div>
                </div>
                <div style="position:absolute; right:-8px; bottom:-8px; opacity:.05; color:#1e3a8a;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:4rem;height:4rem;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                    </svg>
                </div>
            </div>

            {{-- Dikembalikan --}}
            <div style="position:relative; overflow:hidden; padding:1.5rem; background:white; border-radius:1rem; box-shadow:0 1px 3px rgba(0,0,0,.08); border:1px solid #e5e7eb; transition:box-shadow .2s;"
                 onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,.12)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,.08)'">
                <div style="display:flex; align-items:center; gap:1rem;">
                    <div style="padding:.75rem; background:#f0fdf4; border-radius:.75rem; color:#16a34a; flex-shrink:0;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:1.5rem;height:1.5rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                    </div>
                    <div>
                        <p style="font-size:.8rem; font-weight:500; color:#6b7280; margin:0;">Dikembalikan</p>
                        <p style="font-size:1.75rem; font-weight:700; color:#111827; margin:0; line-height:1.2;">{{ number_format($stats['total_kembali']) }}</p>
                    </div>
                </div>
                <div style="position:absolute; right:-8px; bottom:-8px; opacity:.05; color:#14532d;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:4rem;height:4rem;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                </div>
            </div>

            {{-- Terlambat --}}
            <div style="position:relative; overflow:hidden; padding:1.5rem; background:white; border-radius:1rem; box-shadow:0 1px 3px rgba(0,0,0,.08); border:1px solid #fee2e2; transition:box-shadow .2s;"
                 onmouseover="this.style.boxShadow='0 4px 12px rgba(239,68,68,.15)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,.08)'">
                <div style="display:flex; align-items:center; gap:1rem;">
                    <div style="padding:.75rem; background:#fef2f2; border-radius:.75rem; color:#dc2626; flex-shrink:0;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:1.5rem;height:1.5rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <div>
                        <p style="font-size:.8rem; font-weight:500; color:#6b7280; margin:0;">Terlambat</p>
                        <p style="font-size:1.75rem; font-weight:700; color:#dc2626; margin:0; line-height:1.2;">{{ number_format($stats['terlambat']) }}</p>
                    </div>
                </div>
                <div style="position:absolute; right:-8px; bottom:-8px; opacity:.05; color:#7f1d1d;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:4rem;height:4rem;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                </div>
            </div>
            {{-- Total Denda --}}
            <div style="position:relative; overflow:hidden; padding:1.5rem; background:white; border-radius:1rem; box-shadow:0 1px 3px rgba(0,0,0,.08); border:1px solid #fde8d8; transition:box-shadow .2s;"
                 onmouseover="this.style.boxShadow='0 4px 12px rgba(249,115,22,.15)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,.08)'">
                <div style="display:flex; align-items:center; gap:1rem;">
                    <div style="padding:.75rem; background:#fff7ed; border-radius:.75rem; color:#ea580c; flex-shrink:0;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:1.5rem;height:1.5rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                        </svg>
                    </div>
                    <div>
                        <p style="font-size:.8rem; font-weight:500; color:#6b7280; margin:0;">Total Denda</p>
                        <p style="font-size:1.35rem; font-weight:700; color:#ea580c; margin:0; line-height:1.2;">Rp {{ number_format($stats['total_denda'], 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter & Action Section --}}
        <div style="background:white; border-radius:1rem; box-shadow:0 1px 3px rgba(0,0,0,.08); border:1px solid #e5e7eb; padding:2rem;">
            <h3 style="font-size:1rem; font-weight:700; margin:0 0 1.25rem 0; display:flex; align-items:center; gap:.5rem; color:#111827;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:1.2rem;height:1.2rem;color:#f59e0b;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
                Ekspor Laporan
            </h3>

            <form wire:submit="submit">
                {{ $this->form }}
            </form>

            @php
                $type  = $this->data['report_type'] ?? 'peminjaman';
                $start = $this->data['start_date'] ?? now()->startOfMonth()->format('Y-m-d');
                $end   = $this->data['end_date'] ?? now()->endOfMonth()->format('Y-m-d');
            @endphp

            <div style="margin-top:2rem; padding-top:1.25rem; border-top:1px solid #f3f4f6; display:flex; flex-wrap:wrap; gap:.75rem; align-items:center;">
                <a href="{{ route('laporan.export', ['type' => $type, 'format' => 'pdf', 'start' => $start, 'end' => $end]) }}" target="_blank">
                    <x-filament::button type="button" color="danger" icon="heroicon-m-document-text" size="lg" tag="span">
                        Ekspor PDF
                    </x-filament::button>
                </a>
                <a href="{{ route('laporan.export', ['type' => $type, 'format' => 'xlsx', 'start' => $start, 'end' => $end]) }}">
                    <x-filament::button type="button" color="success" icon="heroicon-m-table-cells" size="lg" tag="span">
                        Ekspor Excel
                    </x-filament::button>
                </a>
                <x-filament::button wire:click="printLaporan" icon="heroicon-m-printer" color="gray" size="lg" outlined>
                    Cetak Halaman
                </x-filament::button>
            </div>
        </div>
    </div>

    {{-- Printable Document (Hidden in Web, Only for Printer) --}}
    <div id="laporan-cetak" style="font-family:Georgia,serif; background:white; color:black; padding:3rem;">
        {{-- KOP SURAT --}}
        {{-- KOP Surat --}}
        <div style="display:flex; align-items:center; border-bottom:4px double black; padding-bottom:1rem; margin-bottom:1.5rem;">
            <div style="flex: 0 0 15%; text-align:center;">
                <img src="{{ asset('images/logo.png') }}" style="width: 80px; height: auto;" alt="Logo">
            </div>
            <div style="flex: 1; text-align:center; padding-right: 15%;">
                <h1 style="font-size:1.1rem; font-weight:800; text-transform:uppercase; letter-spacing:.05em; margin:0;">KEMENTERIAN AGAMA REPUBLIK INDONESIA</h1>
                <h2 style="font-size:1rem; font-weight:700; text-transform:uppercase; margin:.15rem 0;">MADRASAH TSANAWIYAH NEGERI AL IHSAN</h2>
                <p style="font-size:.8rem; font-style:italic; margin:.1rem 0;">Gambah Dalam, Kec. Kandangan, Kabupaten Hulu Sungai Selatan, Kalimantan Selatan</p>
                <p style="font-size:.8rem; font-weight:600; margin:.1rem 0;">Gedung Perpustakaan - Sistem Manajemen Digital</p>
            </div>
        </div>

        <div style="text-align:center; margin-bottom:2rem;">
            <h3 style="font-size:1rem; font-weight:700; text-decoration:underline; text-transform:uppercase; margin:0;">LAPORAN REKAPITULASI PERPUSTAKAAN</h3>
            <p style="margin:.25rem 0; font-weight:500; font-style:italic;">
                Periode: {{ \Carbon\Carbon::parse($data['start_date'])->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($data['end_date'])->format('d M Y') }}
            </p>
        </div>

        <div style="margin-bottom:2rem;">
            <p style="margin-bottom:1rem; text-align:justify;">Berdasarkan data sirkulasi buku pada sistem manajemen perpustakaan digital MTSN Al Ihsan, berikut adalah ringkasan aktivitas perpustakaan pada periode tersebut:</p>

            <table style="width:100%; border-collapse:collapse; font-size:.85rem;">
                <thead>
                    <tr style="background:#f9fafb; border-bottom:1px solid black;">
                        <th style="border:1px solid black; padding:.6rem .75rem; text-align:left; width:2.5rem;">No</th>
                        <th style="border:1px solid black; padding:.6rem .75rem; text-align:left;">Deskripsi Aktivitas / Aset</th>
                        <th style="border:1px solid black; padding:.6rem .75rem; text-align:center; width:7rem;">Jumlah</th>
                        <th style="border:1px solid black; padding:.6rem .75rem; text-align:left; width:11rem;">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="border:1px solid black; padding:.6rem .75rem; text-align:center;">1</td>
                        <td style="border:1px solid black; padding:.6rem .75rem; text-transform:uppercase; font-weight:600;">Total Koleksi Buku (Aktif)</td>
                        <td style="border:1px solid black; padding:.6rem .75rem; text-align:center; font-weight:700;">{{ $stats['total_buku'] }}</td>
                        <td style="border:1px solid black; padding:.6rem .75rem; font-style:italic;">Seluruh stok judul &amp; eksemplar</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black; padding:.6rem .75rem; text-align:center;">2</td>
                        <td style="border:1px solid black; padding:.6rem .75rem; text-transform:uppercase; font-weight:600;">Sirkulasi Peminjaman Buku</td>
                        <td style="border:1px solid black; padding:.6rem .75rem; text-align:center; font-weight:700;">{{ $stats['total_pinjam'] }}</td>
                        <td style="border:1px solid black; padding:.6rem .75rem; font-style:italic;">Transaksi keluar</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black; padding:.6rem .75rem; text-align:center;">3</td>
                        <td style="border:1px solid black; padding:.6rem .75rem; text-transform:uppercase; font-weight:600;">Sirkulasi Pengembalian Buku</td>
                        <td style="border:1px solid black; padding:.6rem .75rem; text-align:center; font-weight:700;">{{ $stats['total_kembali'] }}</td>
                        <td style="border:1px solid black; padding:.6rem .75rem; font-style:italic;">Transaksi masuk</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black; padding:.6rem .75rem; text-align:center;">4</td>
                        <td style="border:1px solid black; padding:.6rem .75rem; text-transform:uppercase; font-weight:600;">Total Denda Keterlambatan</td>
                        <td style="border:1px solid black; padding:.6rem .75rem; text-align:center; font-weight:700;">Rp {{ number_format($stats['total_denda'], 0, ',', '.') }}</td>
                        <td style="border:1px solid black; padding:.6rem .75rem; font-style:italic;">Akumulasi periode</td>
                    </tr>
                    <tr style="color:#b91c1c;">
                        <td style="border:1px solid black; padding:.6rem .75rem; text-align:center; border-top:2px double black;">5</td>
                        <td style="border:1px solid black; padding:.6rem .75rem; text-transform:uppercase; font-weight:600; font-style:italic; border-top:2px double black;">Buku Belum Kembali (Terlambat)</td>
                        <td style="border:1px solid black; padding:.6rem .75rem; text-align:center; font-weight:700; text-decoration:underline; border-top:2px double black;">{{ $stats['terlambat'] }}</td>
                        <td style="border:1px solid black; padding:.6rem .75rem; font-style:italic; border-top:2px double black;">Perlu tindak lanjut</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p style="font-size:.8rem; margin-bottom:3rem; font-style:italic;">Demikian laporan ini dibuat secara otomatis melalui sistem untuk dipergunakan sebagaimana mestinya.</p>

        <div style="display:flex; justify-content:space-between;">
            <div style="text-align:center; width:16rem;">
                <p style="margin:0;">Mengetahui,</p>
                <p style="font-weight:700; margin:.15rem 0;">Kepala Perpustakaan</p>
                <div style="height:5rem;"></div>
                <p style="font-weight:700; margin:0;">_________________________</p>
                <p style="margin:.15rem 0;">NIP. ..............................</p>
            </div>
            <div style="text-align:center; width:16rem;">
                <p style="margin:0;">Pekalongan, {{ now()->translatedFormat('d F Y') }}</p>
                <p style="font-weight:700; margin:.15rem 0;">Dibuat Oleh,</p>
                <div style="height:5rem;"></div>
                <p style="font-weight:700; text-transform:uppercase; margin:0;">{{ Auth::user()->name ?? 'Pustakawan' }}</p>
                <p style="margin:.15rem 0;">NIP. {{ Auth::user()->username ?? '..............................' }}</p>
            </div>
        </div>
    </div>
</x-filament-panels::page>
