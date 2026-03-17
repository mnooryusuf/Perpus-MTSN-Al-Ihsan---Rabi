<?php

namespace App\Filament\Resources\Buku;

use App\Filament\Resources\Buku\Pages\CreateBuku;
use App\Filament\Resources\Buku\Pages\EditBuku;
use App\Filament\Resources\Buku\Pages\ListBuku;
use App\Filament\Resources\Buku\Schemas\BukuForm;
use App\Filament\Resources\Buku\Tables\BukuTable;
use App\Models\Buku;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BukuResource extends Resource
{
    protected static ?string $model = Buku::class;

    protected static ?string $navigationLabel = 'Buku';

    protected static ?string $modelLabel = 'Buku';

    protected static ?string $pluralModelLabel = 'Buku';

    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    public static function form(Schema $schema): Schema
    {
        return BukuForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BukuTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBuku::route('/'),
            'create' => CreateBuku::route('/create'),
            'edit' => EditBuku::route('/{record}/edit'),
        ];
    }
}
