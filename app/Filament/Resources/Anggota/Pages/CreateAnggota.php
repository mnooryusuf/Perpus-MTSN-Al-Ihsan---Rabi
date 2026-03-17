<?php

namespace App\Filament\Resources\Anggota\Pages;

use App\Filament\Resources\Anggota\AnggotaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAnggota extends CreateRecord
{
    protected static string $resource = AnggotaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = \App\Models\User::create([
            'name' => $data['name'],
            'username' => $data['nis_nip'],
            'password' => \Illuminate\Support\Facades\Hash::make($data['nis_nip']), // Default password is NIS/NIP
            'role' => $data['role'],
        ]);

        $data['user_id'] = $user->id;

        return $data;
    }
}
