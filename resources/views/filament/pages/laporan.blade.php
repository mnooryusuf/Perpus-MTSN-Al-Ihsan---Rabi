<x-filament-panels::page>
    {{-- Non-Printable UI --}}
    <div class="print:hidden" style="display:flex; flex-direction:column; gap:1.5rem;">

        {{-- Stats Grid --}}
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:1.5rem;">

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
        </div>

        {{-- Filter & Action Section --}}
        <div style="background:white; border-radius:1rem; box-shadow:0 1px 3px rgba(0,0,0,.08); border:1px solid #e5e7eb; padding:2rem;">
            <h3 style="font-size:1rem; font-weight:700; margin:0 0 1.25rem 0; display:flex; align-items:center; gap:.5rem; color:#111827;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:1.2rem;height:1.2rem;color:#f59e0b;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                </svg>
                Filter Laporan
            </h3>

            <form wire:submit="submit">
                {{ $this->form }}
            </form>

            <div style="margin-top:2rem; padding-top:1.25rem; border-top:1px solid #f3f4f6; display:flex; flex-wrap:wrap; gap:.75rem; align-items:center;">
                <x-filament::button wire:click="printLaporan" icon="heroicon-m-printer" color="primary" size="lg">
                    Cetak Laporan Resmi
                </x-filament::button>
                <x-filament::button color="gray" icon="heroicon-m-arrow-down-tray" size="lg" outlined>
                    Ekspor Excel
                </x-filament::button>
            </div>
        </div>
    </div>

    {{-- Printable Document (Hidden in Web, Only for Printer) --}}
    <div class="hidden print:block" style="font-family:Georgia,serif; background:white; color:black; padding:3rem;">
        {{-- KOP SURAT --}}
        <div style="display:flex; align-items:center; justify-content:center; border-bottom:4px double black; padding-bottom:1rem; margin-bottom:1.5rem;">
            <div style="text-align:center;">
                <h1 style="font-size:1.1rem; font-weight:800; text-transform:uppercase; letter-spacing:.05em; margin:0;">KEMENTERIAN AGAMA REPUBLIK INDONESIA</h1>
                <h2 style="font-size:1rem; font-weight:700; text-transform:uppercase; margin:.15rem 0;">MADRASAH TSANAWIYAH NEGERI AL IHSAN - RABI</h2>
                <p style="font-size:.8rem; font-style:italic; margin:.1rem 0;">Jl. Raya Rabi No. 123, Pekalongan, Jawa Tengah</p>
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
            <p style="margin-bottom:1rem; text-align:justify;">Berdasarkan data sirkulasi buku pada sistem manajemen perpustakaan digital MTSN Al Ihsan - Rabi, berikut adalah ringkasan aktivitas perpustakaan pada periode tersebut:</p>

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
                    <tr style="color:#b91c1c;">
                        <td style="border:1px solid black; padding:.6rem .75rem; text-align:center; border-top:2px double black;">4</td>
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
