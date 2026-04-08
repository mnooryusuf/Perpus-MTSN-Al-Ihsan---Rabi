<?php

namespace App\Filament\Pages;

use BackedEnum;
use UnitEnum;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Pengaturan extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string|UnitEnum|null   $navigationGroup = 'Pengaturan';
    protected static ?string $navigationLabel = 'Pengaturan';
    protected static ?string $title           = 'Pengaturan Akun';
    protected static ?int    $navigationSort  = 99;

    protected string $view = 'filament.pages.pengaturan';

    // Use $data array with statePath for proper Filament component lifecycle
    public ?array $data = [];

    public function mount(): void
    {
        $user = Auth::user();
        $anggota = $user->anggota;

        $this->form->fill([
            'name'       => $user->name,
            'username'   => $user->username,
            'email'      => $user->email,
            'avatar'     => $user->avatar_url ? [$user->avatar_url] : [],
            'nis_nip'    => $anggota?->nis_nip,
            'kelas'      => $anggota?->kelas,
            'alamat'     => $anggota?->alamat,
            'no_hp'      => $anggota?->no_hp,
        ]);
    }

    public function form(Schema $form): Schema
    {
        $user = Auth::user();
        $hasAnggota = (bool) $user->anggota;

        $schema = [
            Section::make('Informasi Akun')
                ->description('Ubah data akun dan foto profil Anda di sini.')
                ->schema([
                    FileUpload::make('avatar')
                        ->label('Foto Profil')
                        ->image()
                        ->avatar()
                        ->imageEditor()
                        ->directory('avatars')
                        ->disk('public')
                        ->visibility('public')
                        ->columnSpanFull(),
                    TextInput::make('name')
                        ->label('Nama Lengkap')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('username')
                        ->label('Nama Pengguna (Username)')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->label('Alamat Email')
                        ->email()
                        ->maxLength(255),
                ])->columns(2),

            Section::make('Ganti Kata Sandi')
                ->description('Kosongkan jika tidak ingin mengganti kata sandi.')
                ->schema([
                    TextInput::make('password')
                        ->label('Kata Sandi Baru')
                        ->password()
                        ->revealable()
                        ->confirmed()
                        ->minLength(8)
                        ->maxLength(255),
                    TextInput::make('password_confirmation')
                        ->label('Konfirmasi Kata Sandi')
                        ->password()
                        ->revealable()
                        ->maxLength(255),
                ])->columns(2),
        ];

        if ($hasAnggota) {
            $schema[] = Section::make('Data Anggota')
                ->description('Informasi keanggotaan perpustakaan Anda.')
                ->schema([
                    TextInput::make('nis_nip')
                        ->label('NIS / NIP')
                        ->disabled()
                        ->dehydrated(false),
                    TextInput::make('kelas')
                        ->label('Kelas / Jabatan')
                        ->placeholder('Contoh: VII A / Guru PAI')
                        ->maxLength(50),
                    TextInput::make('alamat')
                        ->label('Alamat')
                        ->placeholder('Alamat lengkap...')
                        ->maxLength(255),
                    TextInput::make('no_hp')
                        ->label('No. HP / WhatsApp')
                        ->placeholder('08xxxxxxxxxx')
                        ->tel()
                        ->maxLength(20),
                ])->columns(2);
        }

        return $form
            ->schema($schema)
            ->statePath('data');
    }

    public function save(): void
    {
        $formData = $this->form->getState();

        $user = Auth::user();

        $userData = [
            'name'       => $formData['name'],
            'username'   => $formData['username'],
            'email'      => $formData['email'],
            'avatar_url' => $formData['avatar'] ?? null,
        ];

        if (filled($formData['password'] ?? null)) {
            $userData['password'] = Hash::make($formData['password']);
        }

        $user->update($userData);

        if ($user->anggota) {
            $user->anggota->update([
                'kelas'  => $formData['kelas'] ?? null,
                'alamat' => $formData['alamat'] ?? null,
                'no_hp'  => $formData['no_hp'] ?? null,
            ]);
        }

        // Reset password fields but keep other data
        $this->form->fill([
            'name'       => $user->refresh()->name,
            'username'   => $user->username,
            'email'      => $user->email,
            'avatar'     => $user->avatar_url ? [$user->avatar_url] : [],
            'nis_nip'    => $user->anggota?->nis_nip,
            'kelas'      => $user->anggota?->kelas,
            'alamat'     => $user->anggota?->alamat,
            'no_hp'      => $user->anggota?->no_hp,
        ]);

        Notification::make()
            ->title('Pengaturan berhasil disimpan!')
            ->success()
            ->send();
    }
}
