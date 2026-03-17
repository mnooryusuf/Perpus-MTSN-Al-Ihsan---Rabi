<?php

namespace App\Filament\Resources\Buku\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BukuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->label('Judul Buku')
                    ->placeholder('Masukkan judul buku...')
                    ->required(),
                TextInput::make('penulis')
                    ->label('Penulis')
                    ->placeholder('Masukkan nama penulis...')
                    ->required(),
                TextInput::make('penerbit')
                    ->label('Penerbit')
                    ->placeholder('Masukkan nama penerbit...')
                    ->required(),
                TextInput::make('tahun_terbit')
                    ->label('Tahun Terbit')
                    ->placeholder('Contoh: 2024')
                    ->required(),
                TextInput::make('kategori')
                    ->label('Kategori')
                    ->placeholder('Masukkan kategori buku...')
                    ->required(),
                TextInput::make('jumlah_eksemplar')
                    ->label('Jumlah Eksemplar')
                    ->placeholder('0')
                    ->required()
                    ->numeric(),
            ]);
    }
}
