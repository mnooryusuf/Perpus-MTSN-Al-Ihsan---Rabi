<?php

namespace App\Filament\Resources\Laporan\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LaporanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('periode')
                    ->label('Periode Laporan')
                    ->placeholder('Contoh: Maret 2024')
                    ->required(),
                TextInput::make('total_buku')
                    ->label('Total Koleksi Buku')
                    ->placeholder('0')
                    ->required()
                    ->numeric(),
                TextInput::make('total_pinjam')
                    ->label('Total Peminjaman')
                    ->placeholder('0')
                    ->required()
                    ->numeric(),
                TextInput::make('total_kembali')
                    ->label('Total Pengembalian')
                    ->placeholder('0')
                    ->required()
                    ->numeric(),
            ]);
    }
}
