<?php

namespace App\Filament\Resources\Anggota;

use App\Filament\Resources\Anggota\Pages\CreateAnggota;
use App\Filament\Resources\Anggota\Pages\EditAnggota;
use App\Filament\Resources\Anggota\Pages\ListAnggota;
use App\Filament\Resources\Anggota\Schemas\AnggotaForm;
use App\Filament\Resources\Anggota\Tables\AnggotaTable;
use App\Models\Anggota;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AnggotaResource extends Resource
{
    protected static ?string $model = Anggota::class;

    protected static ?string $navigationLabel = 'Anggota';

    protected static ?string $modelLabel = 'Anggota';

    protected static ?string $pluralModelLabel = 'Anggota';

    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    public static function form(Schema $schema): Schema
    {
        return AnggotaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AnggotaTable::configure($table);
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
            'index' => ListAnggota::route('/'),
            'create' => CreateAnggota::route('/create'),
            'edit' => EditAnggota::route('/{record}/edit'),
        ];
    }
}
