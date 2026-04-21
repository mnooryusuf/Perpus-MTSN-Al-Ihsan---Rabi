<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;

class PengembalianExport implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    public function __construct(
        protected Collection $items,
        protected string $startDate,
        protected string $endDate,
    ) {}

    public function title(): string
    {
        return 'Transaksi Pengembalian';
    }

    public function headings(): array
    {
        return ['No', 'NIS/NIP', 'Nama Anggota', 'Judul Buku', 'Tgl Pinjam', 'Tgl Dikembalikan', 'Denda'];
    }

    public function collection(): Collection
    {
        return $this->items->values()->map(function ($t, $i) {
            return [
                $i + 1,
                $t->anggota?->nis_nip ?? '-',
                $t->anggota?->user?->name ?? '-',
                $t->buku?->judul ?? '-',
                $t->tanggal_pinjam,
                $t->tanggal_dikembalikan,
                $t->denda > 0 ? 'Rp ' . number_format($t->denda, 0, ',', '.') : '-',
            ];
        });
    }

    public function columnWidths(): array
    {
        return ['A' => 5, 'B' => 20, 'C' => 25, 'D' => 35, 'E' => 15, 'F' => 18, 'G' => 18];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF4472C4']],
                'borders' => ['allBorders' => ['borderStyle' => 'thin']],
            ],
        ];
    }
}
