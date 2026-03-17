<?php

namespace App\Filament\Resources\User\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->placeholder('Masukkan nama lengkap...')
                    ->required(),
                TextInput::make('username')
                    ->label('Nama Pengguna')
                    ->placeholder('Masukkan username...')
                    ->required(),
                TextInput::make('email')
                    ->label('Alamat Email')
                    ->placeholder('contoh@email.com')
                    ->email(),
                DateTimePicker::make('email_verified_at')
                    ->label('Email Diverifikasi Pada'),
                TextInput::make('password')
                    ->label('Kata Sandi')
                    ->placeholder('********')
                    ->password()
                    ->revealable()
                    ->required(),
                Select::make('role')
                    ->label('Peran / Jabatan')
                    ->options(['pustakawan' => 'Pustakawan', 'siswa' => 'Siswa', 'guru' => 'Guru'])
                    ->default('pustakawan')
                    ->required(),
            ]);
    }
}
