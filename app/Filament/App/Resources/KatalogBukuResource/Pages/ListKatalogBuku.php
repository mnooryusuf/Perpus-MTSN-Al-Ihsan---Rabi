<?php

namespace App\Filament\App\Resources\KatalogBukuResource\Pages;

use App\Filament\App\Resources\KatalogBukuResource;
use Filament\Resources\Pages\ListRecords;

class ListKatalogBuku extends ListRecords
{
    protected static string $resource = KatalogBukuResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
