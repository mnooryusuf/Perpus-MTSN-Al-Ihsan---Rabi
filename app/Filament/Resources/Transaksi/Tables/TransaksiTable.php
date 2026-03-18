<?php

namespace App\Filament\Resources\Transaksi\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransaksiTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('anggota.nis_nip')
                    ->label('Anggota (NIS/NIP)')
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
                        'dipinjam' => 'warning',
                        'dikembalikan' => 'success',
                        'terlambat' => 'danger',
                        default => 'gray',
                    }),
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
                Action::make('kembalikan')
                    ->label('Kembalikan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Kembalikan Buku')
                    ->modalDescription('Apakah Anda yakin ingin menandai buku ini sebagai sudah dikembalikan hari ini?')
                    ->action(function ($record) {
                        $record->update([
                            'tanggal_dikembalikan' => now(),
                            'status' => 'dikembalikan',
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
