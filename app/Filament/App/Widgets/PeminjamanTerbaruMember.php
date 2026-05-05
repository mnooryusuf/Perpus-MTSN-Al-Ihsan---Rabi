<?php

namespace App\Filament\App\Widgets;

use App\Models\Transaksi;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class PeminjamanTerbaruMember extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Peminjaman Saya Terbaru';

    public function table(Table $table): Table
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return $table
            ->query(
                Transaksi::query()
                    ->where('id_anggota', $user->anggota?->nis_nip)
                    ->with(['buku'])
                    ->latest('created_at')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('buku.judul')
                    ->label('Judul Buku')
                    ->icon('heroicon-m-book-open')
                    ->iconColor('primary')
                    ->limit(35),

                Tables\Columns\TextColumn::make('tanggal_pinjam')
                    ->label('Tgl Pinjam')
                    ->date('d M Y')
                    ->color('gray'),

                Tables\Columns\TextColumn::make('tanggal_kembali')
                    ->label('Batas Kembali')
                    ->date('d M Y')
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
                    }),

                Tables\Columns\TextColumn::make('denda')
                    ->label('Denda')
                    ->money('idr')
                    ->color(fn ($state): string => $state > 0 ? 'danger' : 'gray')
                    ->placeholder('—'),
            ])
            ->paginated(false)
            ->emptyStateHeading('Belum ada riwayat peminjaman');
    }
}
