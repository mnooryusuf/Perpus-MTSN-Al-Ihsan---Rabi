<?php

namespace App\Exports;

use App\Models\Buku;
use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;

class LaporanExport implements WithMultipleSheets
{
    public function __construct(
        protected string $startDate,
        protected string $endDate,
    ) {}

    public function sheets(): array
    {
        return [
            new LaporanRingkasanSheet($this->startDate, $this->endDate),
            new LaporanDetailSheet($this->startDate, $this->endDate),
        ];
    }
}

// ── Sheet 1: Ringkasan Statistik ──────────────────────────────────

class LaporanRingkasanSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    public function __construct(
        protected string $startDate,
        protected string $endDate,
    ) {}

    public function title(): string
    {
        return 'Ringkasan';
    }

    public function headings(): array
    {
        return [
            ['LAPORAN REKAPITULASI PERPUSTAKAAN'],
            ['MTSN Al Ihsan - Rabi'],
            ['Periode: ' . \Carbon\Carbon::parse($this->startDate)->format('d M Y') . ' s/d ' . \Carbon\Carbon::parse($this->endDate)->format('d M Y')],
            [],
            ['No', 'Deskripsi', 'Jumlah', 'Keterangan'],
        ];
    }

    public function collection(): Collection
    {
        $totalBuku = Buku::sum('jumlah_eksemplar');
        $totalPinjam = Transaksi::whereBetween('tanggal_pinjam', [$this->startDate, $this->endDate])->count();
        $totalKembali = Transaksi::whereBetween('tanggal_dikembalikan', [$this->startDate, $this->endDate])->count();
        $terlambat = Transaksi::whereNull('tanggal_dikembalikan')
            ->where('tanggal_kembali', '<', now())
            ->count();
        $totalDenda = Transaksi::whereBetween('tanggal_dikembalikan', [$this->startDate, $this->endDate])
            ->where('denda', '>', 0)
            ->sum('denda');

        return collect([
            [1, 'Total Koleksi Buku (Aktif)', $totalBuku, 'Seluruh stok judul & eksemplar'],
            [2, 'Sirkulasi Peminjaman Buku', $totalPinjam, 'Transaksi keluar'],
            [3, 'Sirkulasi Pengembalian Buku', $totalKembali, 'Transaksi masuk'],
            [4, 'Total Denda Keterlambatan', 'Rp ' . number_format($totalDenda, 0, ',', '.'), 'Akumulasi periode'],
            [5, 'Buku Belum Kembali (Terlambat)', $terlambat, 'Perlu tindak lanjut'],
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 40,
            'C' => 20,
            'D' => 30,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        // Merge title rows
        $sheet->mergeCells('A1:D1');
        $sheet->mergeCells('A2:D2');
        $sheet->mergeCells('A3:D3');

        return [
            1 => [
                'font' => ['bold' => true, 'size' => 14],
                'alignment' => ['horizontal' => 'center'],
            ],
            2 => [
                'font' => ['bold' => true, 'size' => 12],
                'alignment' => ['horizontal' => 'center'],
            ],
            3 => [
                'font' => ['italic' => true, 'size' => 10],
                'alignment' => ['horizontal' => 'center'],
            ],
            5 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['argb' => 'FF4472C4'],
                ],
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'borders' => [
                    'allBorders' => ['borderStyle' => 'thin'],
                ],
            ],
            '6:10' => [
                'borders' => [
                    'allBorders' => ['borderStyle' => 'thin'],
                ],
            ],
        ];
    }
}

// ── Sheet 2: Detail Transaksi ─────────────────────────────────────

class LaporanDetailSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    public function __construct(
        protected string $startDate,
        protected string $endDate,
    ) {}

    public function title(): string
    {
        return 'Detail Transaksi';
    }

    public function headings(): array
    {
        return [
            'No',
            'NIS/NIP',
            'Nama Anggota',
            'Judul Buku',
            'Tgl Pinjam',
            'Tgl Harus Kembali',
            'Tgl Dikembalikan',
            'Status',
            'Denda',
        ];
    }

    public function collection(): Collection
    {
        $transaksis = Transaksi::with(['anggota.user', 'buku'])
            ->whereBetween('tanggal_pinjam', [$this->startDate, $this->endDate])
            ->orderBy('tanggal_pinjam', 'desc')
            ->get();

        return $transaksis->values()->map(function ($t, $index) {
            return [
                $index + 1,
                $t->anggota?->nis_nip ?? '-',
                $t->anggota?->user?->name ?? '-',
                $t->buku?->judul ?? '-',
                $t->tanggal_pinjam,
                $t->tanggal_kembali,
                $t->tanggal_dikembalikan ?? '-',
                ucfirst($t->status),
                $t->denda ? 'Rp ' . number_format($t->denda, 0, ',', '.') : '-',
            ];
        });
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 15,
            'C' => 25,
            'D' => 35,
            'E' => 15,
            'F' => 18,
            'G' => 18,
            'H' => 14,
            'I' => 18,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['argb' => 'FF4472C4'],
                ],
                'borders' => [
                    'allBorders' => ['borderStyle' => 'thin'],
                ],
            ],
        ];
    }
}
