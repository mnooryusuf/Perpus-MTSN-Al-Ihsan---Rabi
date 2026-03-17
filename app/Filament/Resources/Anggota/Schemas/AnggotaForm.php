<?php

namespace App\Filament\Resources\Anggota\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use App\Models\User;
use Filament\Schemas\Schema;

class AnggotaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nis_nip')
                    ->label('NIS/NIP')
                    ->placeholder('Masukkan NIS atau NIP...')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->placeholder('Masukkan nama lengkap...')
                    ->required()
                    ->maxLength(255),
                Select::make('role')
                    ->label('Role')
                    ->options([
                        'siswa' => 'Siswa',
                        'guru' => 'Guru',
                    ])
                    ->required()
                    ->default('siswa')
                    ->live(),
                TextInput::make('kelas')
                    ->label('Kelas')
                    ->placeholder('Masukkan kelas (contoh: VII-A)...')
                    ->helperText('Kosongkan jika anggota adalah Guru.')
                    ->visible(fn (callable $get) => $get('role') === 'siswa'),
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
