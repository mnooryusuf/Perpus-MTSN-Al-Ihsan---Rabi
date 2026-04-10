<?php

namespace App\Filament\Widgets;

use App\Models\Transaksi;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PeminjamanTerbaru extends BaseWidget
{
    protected static ?int $sort = -1;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Peminjaman Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Transaksi::query()
                    ->with(['anggota.user', 'buku'])
                    ->latest('created_at')
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('buku.judul')
                    ->label('Judul Buku')
                    ->icon('heroicon-m-book-open')
                    ->iconColor('primary')
                    ->searchable()
                    ->limit(35),

                Tables\Columns\TextColumn::make('anggota.user.name')
                    ->label('Peminjam')
                    ->icon('heroicon-m-user')
                    ->iconColor('gray')
                    ->searchable(),

                Tables\Columns\TextColumn::make('tanggal_pinjam')
                    ->label('Tgl Pinjam')
                    ->date('d M Y')
                    ->sortable()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('tanggal_kembali')
                    ->label('Batas Kembali')
                    ->date('d M Y')
                    ->sortable()
                    ->color(fn (Transaksi $record): string =>
                        $record->status === 'dipinjam' && $record->tanggal_kembali < now()
                            ? 'danger'
                            : 'gray'
                    ),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'dipinjam' => 'warning',
                        'dikembalikan' => 'success',
                        'terlambat' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'dipinjam' => 'Dipinjam',
                        'dikembalikan' => 'Dikembalikan',
                        'terlambat' => 'Terlambat',
                        default => ucfirst($state),
                    }),

                Tables\Columns\TextColumn::make('denda')
                    ->label('Denda')
                    ->money('idr')
                    ->color(fn ($state): string => $state > 0 ? 'danger' : 'gray')
                    ->placeholder('—'),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([5])
            ->poll('30s');
    }
}
