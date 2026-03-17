<?php

namespace App\Filament\Resources\Laporan;

use App\Filament\Resources\Laporan\Pages\CreateLaporan;
use App\Filament\Resources\Laporan\Pages\EditLaporan;
use App\Filament\Resources\Laporan\Pages\ListLaporan;
use App\Filament\Resources\Laporan\Schemas\LaporanForm;
use App\Filament\Resources\Laporan\Tables\LaporanTable;
use App\Models\Laporan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LaporanResource extends Resource
{
    protected static ?string $model = Laporan::class;

    protected static ?string $navigationLabel = 'Laporan';

    protected static ?string $modelLabel = 'Laporan';

    protected static ?string $pluralModelLabel = 'Laporan';

    protected static string|\UnitEnum|null $navigationGroup = 'Laporan';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentChartBar;

    public static function form(Schema $schema): Schema
    {
        return LaporanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaporanTable::configure($table);
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
            'index' => ListLaporan::route('/'),
            'create' => CreateLaporan::route('/create'),
            'edit' => EditLaporan::route('/{record}/edit'),
        ];
    }
}
