<?php

namespace App\Filament\Resources\Anggota\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AnggotaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->label('ID Pengguna')
                    ->placeholder('Pilih pengguna...')
                    ->required()
                    ->numeric(),
                TextInput::make('nis_nip')
                    ->label('NIS/NIP')
                    ->placeholder('Masukkan NIS atau NIP...')
                    ->required(),
                TextInput::make('kelas')
                    ->label('Kelas')
                    ->placeholder('Masukkan kelas (contoh: VII-A)...'),
                Textarea::make('alamat')
                    ->label('Alamat')
                    ->placeholder('Masukkan alamat lengkap...')
                    ->columnSpanFull(),
                TextInput::make('no_hp')
                    ->label('Nomor HP')
                    ->placeholder('Masukkan nomor WhatsApp/HP...')
                    ->tel(),
            ]);
    }
}
