<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;

class AnggotaExport implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    public function __construct(protected Collection $items) {}

    public function title(): string
    {
        return 'Data Anggota';
    }

    public function headings(): array
    {
        return ['No', 'NIS/NIP', 'Nama Lengkap', 'Peran', 'Kelas', 'Alamat', 'No HP'];
    }

    public function collection(): Collection
    {
        return $this->items->values()->map(function ($anggota, $i) {
            return [
                $i + 1,
                $anggota->nis_nip,
                $anggota->user?->name ?? '-',
                ucfirst($anggota->user?->role ?? '-'),
                $anggota->kelas ?? '-',
                $anggota->alamat ?? '-',
                $anggota->no_hp ?? '-',
            ];
        });
    }

    public function columnWidths(): array
    {
        return ['A' => 5, 'B' => 20, 'C' => 30, 'D' => 12, 'E' => 12, 'F' => 35, 'G' => 18];
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
