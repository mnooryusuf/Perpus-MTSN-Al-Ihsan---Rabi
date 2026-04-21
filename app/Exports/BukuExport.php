<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;

class BukuExport implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    public function __construct(protected Collection $items) {}

    public function title(): string
    {
        return 'Data Buku';
    }

    public function headings(): array
    {
        return ['No', 'Judul', 'Penulis', 'Penerbit', 'Tahun Terbit', 'Kategori', 'Jumlah Eksemplar', 'Stok Tersedia'];
    }

    public function collection(): Collection
    {
        return $this->items->values()->map(function ($buku, $i) {
            return [
                $i + 1,
                $buku->judul,
                $buku->penulis,
                $buku->penerbit,
                $buku->tahun_terbit,
                $buku->kategori,
                $buku->jumlah_eksemplar,
                $buku->available_stock,
            ];
        });
    }

    public function columnWidths(): array
    {
        return ['A' => 5, 'B' => 35, 'C' => 25, 'D' => 25, 'E' => 14, 'F' => 18, 'G' => 18, 'H' => 15];
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
