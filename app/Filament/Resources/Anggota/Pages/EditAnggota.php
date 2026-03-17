<?php

namespace App\Filament\Resources\Anggota\Pages;

use App\Filament\Resources\Anggota\AnggotaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAnggota extends EditRecord
{
    protected static string $resource = AnggotaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['name'] = $this->record->user->name;
        $data['role'] = $this->record->user->role;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->record->user->update([
            'name' => $data['name'],
            'role' => $data['role'],
        ]);

        return $data;
    }
}
