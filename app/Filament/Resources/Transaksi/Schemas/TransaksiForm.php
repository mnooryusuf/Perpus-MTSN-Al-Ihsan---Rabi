<?php

namespace App\Filament\Resources\Transaksi\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransaksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_anggota')
                    ->label('Anggota')
                    ->relationship('anggota', 'nis_nip')
                    ->searchable()
                    ->placeholder('Pilih anggota (NIS/NIP)...')
                    ->required(),
                Select::make('id_buku')
                    ->label('Buku')
                    ->relationship('buku', 'judul')
                    ->searchable()
                    ->placeholder('Pilih buku yang dipinjam...')
                    ->required(),
                Select::make('id_user')
                    ->label('Pustakawan')
                    ->relationship('pustakawan', 'name')
                    ->default(\Illuminate\Support\Facades\Auth::id())
                    ->required(),
                DatePicker::make('tanggal_pinjam')
                    ->label('Tanggal Pinjam')
                    ->default(now())
                    ->required(),
                DatePicker::make('tanggal_kembali')
                    ->label('Tanggal Kembali')
                    ->default(now()->addDays(7))
                    ->required(),
                DatePicker::make('tanggal_dikembalikan')
                    ->label('Tanggal Dikembalikan'),
                Select::make('status')
                    ->options([
                        'dipinjam' => 'Dipinjam',
                        'dikembalikan' => 'Dikembalikan',
                        'terlambat' => 'Terlambat',
                    ])
                    ->default('dipinjam')
                    ->required(),
            ]);
    }
}
