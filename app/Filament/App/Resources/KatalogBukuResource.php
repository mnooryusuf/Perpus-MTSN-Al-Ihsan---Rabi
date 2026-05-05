<?php

namespace App\Filament\App\Resources;

use App\Filament\Resources\Buku\Tables\BukuTable;
use App\Models\Buku;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class KatalogBukuResource extends Resource
{
    protected static ?string $model = Buku::class;

    protected static ?string $navigationLabel = 'Katalog Buku';

    protected static ?string $modelLabel = 'Buku';

    protected static ?string $pluralModelLabel = 'Katalog Buku';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-book-open';

    public static function table(Table $table): Table
    {
        return BukuTable::configure($table)
            ->actions([
                \Filament\Actions\Action::make('pesan_pinjam')
                    ->label('Pesan Pinjam')
                    ->icon('heroicon-o-shopping-cart')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Pesan Pinjam Buku')
                    ->modalDescription('Buku akan dipesan untuk Anda. Silakan ambil buku di perpustakaan dalam 1x24 jam.')
                    ->action(function ($record) {
                        /** @var \App\Models\User $user */
                        $user = Auth::user();
                        $anggota = $user->anggota;

                        if (!$anggota) {
                            \Filament\Notifications\Notification::make()
                                ->title('Gagal')
                                ->body('Data anggota tidak ditemukan. Silakan hubungi pustakawan.')
                                ->danger()
                                ->send();
                            return;
                        }

                        // Cek apakah sudah ada booking yang sama
                        $existing = \App\Models\Transaksi::where('id_anggota', '=', $anggota->nis_nip, 'and')
                            ->where('id_buku', '=', $record->id_buku, 'and')
                            ->whereIn('status', ['booking', 'dipinjam', 'terlambat'])
                            ->first();

                        if ($existing) {
                            \Filament\Notifications\Notification::make()
                                ->title('Gagal')
                                ->body('Anda sudah meminjam atau memesan buku ini.')
                                ->warning()
                                ->send();
                            return;
                        }

                        \App\Models\Transaksi::create([
                            'id_anggota' => $anggota->nis_nip,
                            'id_buku' => $record->id_buku,
                            'status' => 'booking',
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Berhasil')
                            ->body('Buku berhasil dipesan. Silakan ambil di perpustakaan.')
                            ->success()
                            ->send();
                    })
                    ->visible(fn ($record) => $record->available_stock > 0),
            ])
            ->bulkActions([])
            ->headerActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\App\Resources\KatalogBukuResource\Pages\ListKatalogBuku::route('/'),
        ];
    }
}
