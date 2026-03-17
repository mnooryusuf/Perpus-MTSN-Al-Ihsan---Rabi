<?php

namespace App\Filament\Widgets;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Transaksi;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Buku', Buku::sum('jumlah_eksemplar'))
                ->description('Total eksemplar buku di perpustakaan')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('success'),
            Stat::make('Total Anggota', Anggota::count())
                ->description('Siswa dan Guru terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
            Stat::make('Peminjaman Aktif', Transaksi::where('status', 'dipinjam')->count())
                ->description('Buku yang sedang dipinjam')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('warning'),
        ];
    }
}
