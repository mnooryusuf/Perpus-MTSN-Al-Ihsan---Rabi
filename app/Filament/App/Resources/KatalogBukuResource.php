<?php

namespace App\Filament\App\Resources;

use App\Filament\Resources\Buku\Tables\BukuTable;
use App\Models\Buku;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;

class KatalogBukuResource extends Resource
{
    protected static ?string $model = Buku::class;

    protected static ?string $navigationLabel = 'Katalog Buku';

    protected static ?string $modelLabel = 'Buku';

    protected static ?string $pluralModelLabel = 'Katalog Buku';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-book-open';

    public static function table(Table $table): Table
    {
        return BukuTable::configure($table)
            ->actions([])
            ->bulkActions([])
            ->headerActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\App\Resources\KatalogBukuResource\Pages\ListKatalogBuku::route('/'),
        ];
    }
}
