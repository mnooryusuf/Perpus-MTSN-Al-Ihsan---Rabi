<?php

namespace App\Filament\App\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class DendaStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $anggota = $user->anggota;
        
        if (!$anggota) {
            return [];
        }

        $activeLoans = $anggota->transaksis()
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->count();

        $overdueCount = $anggota->transaksis()
            ->where('status', 'terlambat')
            ->count();

        $totalDenda = $anggota->transaksis()
            ->where('denda', '>', 0)
            ->sum('denda');

        return [
            Stat::make('Buku Dipinjam', $activeLoans)
                ->description('Jumlah buku yang sedang Anda pinjam')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('primary'),
            Stat::make('Buku Terlambat', $overdueCount)
                ->description('Segera kembalikan ke perpustakaan')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($overdueCount > 0 ? 'danger' : 'success'),
            Stat::make('Total Denda', 'Rp ' . number_format($totalDenda, 0, ',', '.'))
                ->description('Total denda yang harus dibayar')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color($totalDenda > 0 ? 'danger' : 'success'),
        ];
    }
}
