<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Transaksi;
use App\Exports\BukuExport;
use App\Exports\AnggotaExport;
use App\Exports\PeminjamanExport;
use App\Exports\PengembalianExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        $type   = $request->query('type', 'buku');
        $format = $request->query('format', 'xlsx');
        $start  = $request->query('start', now()->startOfMonth()->format('Y-m-d'));
        $end    = $request->query('end', now()->endOfMonth()->format('Y-m-d'));

        $data = $this->getData($type, $start, $end);
        $filename = $this->getFilename($type);

        if ($format === 'pdf') {
            return $this->exportPdf($type, $data, $filename);
        }

        return $this->exportXlsx($type, $data, $filename, $start, $end);
    }

    protected function getData(string $type, string $start, string $end): array
    {
        return match ($type) {
            'buku' => [
                'items' => Buku::orderBy('judul')->get(),
                'title' => 'Laporan Data Buku',
            ],
            'anggota' => [
                'items' => Anggota::with('user')->get(),
                'title' => 'Laporan Data Anggota',
            ],
            'peminjaman' => [
                'items' => Transaksi::with(['anggota.user', 'buku'])
                    ->whereBetween('tanggal_pinjam', [$start, $end])
                    ->orderBy('tanggal_pinjam', 'desc')
                    ->get(),
                'title' => 'Laporan Transaksi Peminjaman',
                'start' => $start,
                'end'   => $end,
            ],
            'pengembalian' => [
                'items' => Transaksi::with(['anggota.user', 'buku'])
                    ->whereNotNull('tanggal_dikembalikan')
                    ->whereBetween('tanggal_dikembalikan', [$start, $end])
                    ->orderBy('tanggal_dikembalikan', 'desc')
                    ->get(),
                'title' => 'Laporan Transaksi Pengembalian',
                'start' => $start,
                'end'   => $end,
            ],
            default => ['items' => collect(), 'title' => 'Laporan'],
        };
    }

    protected function exportPdf(string $type, array $data, string $filename)
    {
        $pdf = Pdf::loadView("exports.pdf.{$type}", $data)
            ->setPaper('a4', 'landscape');

        if (ob_get_length()) ob_end_clean();

        return $pdf->download("{$filename}.pdf");
    }

    protected function exportXlsx(string $type, array $data, string $filename, string $start, string $end)
    {
        $export = match ($type) {
            'buku'          => new BukuExport($data['items']),
            'anggota'       => new AnggotaExport($data['items']),
            'peminjaman'    => new PeminjamanExport($data['items'], $start, $end),
            'pengembalian'  => new PengembalianExport($data['items'], $start, $end),
        };

        if (ob_get_length()) ob_end_clean();

        return Excel::download($export, "{$filename}.xlsx");
    }

    protected function getFilename(string $type): string
    {
        $prefix = match ($type) {
            'buku'          => 'Laporan_Buku',
            'anggota'       => 'Laporan_Anggota',
            'peminjaman'    => 'Laporan_Peminjaman',
            'pengembalian'  => 'Laporan_Pengembalian',
        };

        return $prefix . '_' . now()->format('Ymd_His');
    }
}
