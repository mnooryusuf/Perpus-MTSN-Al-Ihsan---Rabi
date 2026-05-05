<?php

namespace App\Filament\App\Resources;

use App\Filament\Resources\Transaksi\Tables\TransaksiTable;
use App\Models\Transaksi;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class PeminjamanResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationLabel = 'Peminjaman Saya';

    protected static ?string $modelLabel = 'Peminjaman';

    protected static ?string $pluralModelLabel = 'Peminjaman Saya';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function table(Table $table): Table
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return TransaksiTable::configure($table)
            ->modifyQueryUsing(fn (Builder $query) => $query->where('id_anggota', $user->anggota?->nis_nip))
            ->actions([])
            ->bulkActions([])
            ->headerActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\App\Resources\PeminjamanResource\Pages\ListPeminjamans::route('/'),
        ];
    }
}
