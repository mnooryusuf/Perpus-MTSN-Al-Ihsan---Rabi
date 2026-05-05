<?php

namespace App\Filament\App\Resources\PeminjamanResource\Pages;

use App\Filament\App\Resources\PeminjamanResource;
use Filament\Resources\Pages\ListRecords;

class ListPeminjamans extends ListRecords
{
    protected static string $resource = PeminjamanResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
