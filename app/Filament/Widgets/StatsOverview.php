<?php

namespace App\Filament\Widgets;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Transaksi;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = -2;

    protected function getStats(): array
    {
        $totalBuku = Buku::sum('jumlah_eksemplar');
        $totalAnggota = Anggota::count();
        $peminjamanAktif = Transaksi::where('status', 'dipinjam')->count();
        $terlambat = Transaksi::where('status', 'dipinjam')
            ->whereDate('tanggal_kembali', '<', now())
            ->count();
        $totalDenda = Transaksi::where('status', 'dikembalikan')
            ->where('denda', '>', 0)
            ->sum('denda');

        // Peminjaman bulan ini vs bulan lalu untuk trend
        $peminjamanBulanIni = Transaksi::whereMonth('tanggal_pinjam', now()->month)
            ->whereYear('tanggal_pinjam', now()->year)
            ->count();
        $peminjamanBulanLalu = Transaksi::whereMonth('tanggal_pinjam', now()->subMonth()->month)
            ->whereYear('tanggal_pinjam', now()->subMonth()->year)
            ->count();

        $trendPeminjaman = $peminjamanBulanLalu > 0
            ? round((($peminjamanBulanIni - $peminjamanBulanLalu) / $peminjamanBulanLalu) * 100)
            : ($peminjamanBulanIni > 0 ? 100 : 0);

        return [
            Stat::make('Total Koleksi Buku', number_format($totalBuku))
                ->description('Eksemplar di perpustakaan')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5]),

            Stat::make('Total Anggota', number_format($totalAnggota))
                ->description('Siswa & Guru terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('info')
                ->chart([3, 5, 4, 3, 6, 5, 7]),

            Stat::make('Peminjaman Aktif', number_format($peminjamanAktif))
                ->description(
                    $terlambat > 0
                        ? "{$terlambat} terlambat!"
                        : 'Semua tepat waktu'
                )
                ->descriptionIcon($terlambat > 0 ? 'heroicon-m-exclamation-triangle' : 'heroicon-m-check-circle')
                ->color($terlambat > 0 ? 'danger' : 'warning')
                ->chart([4, 6, 2, 5, 3, 7, 4]),

            Stat::make('Total Denda', 'Rp ' . number_format($totalDenda, 0, ',', '.'))
                ->description(
                    $trendPeminjaman >= 0
                        ? "Peminjaman ↑ {$trendPeminjaman}% bulan ini"
                        : "Peminjaman ↓ " . abs($trendPeminjaman) . "% bulan ini"
                )
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('gray')
                ->chart([2, 4, 6, 3, 5, 4, 6]),
        ];
    }
}
