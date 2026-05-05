<?php

namespace App\Filament\Resources\Transaksi\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class TransaksiTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('anggota.nis_nip')
                    ->label('Anggota (NIS/NIP)')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('anggota.user.name')
                    ->label('Nama Anggota')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('buku.judul')
                    ->label('Judul Buku')
                    ->sortable(),
                TextColumn::make('pustakawan.name')
                    ->label('Pustakawan')
                    ->sortable(),
                TextColumn::make('tanggal_pinjam')
                    ->label('Tgl Pinjam')
                    ->date()
                    ->sortable(),
                TextColumn::make('tanggal_kembali')
                    ->label('Tgl Kembali')
                    ->date()
                    ->sortable(),
                TextColumn::make('tanggal_dikembalikan')
                    ->label('Tgl Dikembalikan')
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'booking'      => 'info',
                        'dipinjam'     => 'warning',
                        'dikembalikan' => 'success',
                        'terlambat'    => 'danger',
                        default        => 'gray',
                    }),
                TextColumn::make('denda')
                    ->label('Denda')
                    ->formatStateUsing(fn ($state) => $state > 0
                        ? 'Rp ' . number_format($state, 0, ',', '.')
                        : '-')
                    ->color(fn ($state) => $state > 0 ? 'danger' : 'gray')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('konfirmasi')
                    ->label('Konfirmasi Pinjam')
                    ->icon('heroicon-o-hand-thumb-up')
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Peminjaman')
                    ->modalDescription('Apakah buku sudah diserahkan ke siswa dan ingin mengubah status menjadi Dipinjam?')
                    ->action(function ($record) {
                        $record->update([
                            'tanggal_pinjam' => now(),
                            'tanggal_kembali' => now()->addDays(7), // Default 7 hari
                            'status' => 'dipinjam',
                            'id_user' => Auth::id(), // Pustakawan yang konfirmasi
                        ]);
                    })
                    ->visible(fn ($record) => $record->status === 'booking'),
                Action::make('kembalikan')
                    ->label('Kembalikan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Kembalikan Buku')
                    ->modalDescription(fn ($record) => 'Denda yang akan dikenakan: Rp ' . number_format($record->hitungDenda(), 0, ',', '.') . '. Apakah Anda yakin?')
                    ->action(function ($record) {
                        $denda = $record->hitungDenda();
                        $record->update([
                            'tanggal_dikembalikan' => now(),
                            'status'               => 'dikembalikan',
                            'denda'                => $denda,
                        ]);
                    })
                    ->visible(fn ($record) => in_array($record->status, ['dipinjam', 'terlambat'])),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->searchPlaceholder('Cari transaksi...')
            ->emptyStateHeading('Data transaksi tidak ditemukan');
    }
}
