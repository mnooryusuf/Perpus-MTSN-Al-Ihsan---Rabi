<?php

namespace App\Filament\Widgets;

use App\Models\Buku;
use Filament\Widgets\Widget;

class BukuPopuler extends Widget
{
    protected string $view = 'filament.widgets.buku-populer';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 0;

    public function getBukuPopuler(): \Illuminate\Support\Collection
    {
        return Buku::withCount('transaksis')
            ->orderByDesc('transaksis_count')
            ->limit(5)
            ->get();
    }

    public function getMaxPeminjaman(): int
    {
        $max = Buku::withCount('transaksis')
            ->orderByDesc('transaksis_count')
            ->first();

        return $max?->transaksis_count ?: 1;
    }
}
