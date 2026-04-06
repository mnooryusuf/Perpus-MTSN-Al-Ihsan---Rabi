<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use BackedEnum;
use UnitEnum;
use App\Models\Buku;
use App\Models\Transaksi;
use App\Models\Anggota;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class Laporan extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static string|UnitEnum|null $navigationGroup = 'Laporan';
    protected static ?string $navigationLabel = 'Laporan Digital';
    protected static ?string $title = 'Laporan & Statistik';

    protected string $view = 'filament.pages.laporan';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'start_date' => now()->startOfMonth()->format('Y-m-d'),
            'end_date' => now()->endOfMonth()->format('Y-m-d'),
        ]);
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Section::make('Filter Periode Laporan')
                    ->description('Pilih rentang tanggal untuk menghitung statistik secara live.')
                    ->schema([
                        DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->live()
                            ->required(),
                        DatePicker::make('end_date')
                            ->label('Tanggal Selesai')
                            ->live()
                            ->required(),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    protected function getStats(): array
    {
        $start = $this->data['start_date'] ?? now()->startOfMonth();
        $end = $this->data['end_date'] ?? now()->endOfMonth();

        return [
            'total_buku' => Buku::sum('jumlah_eksemplar'),
            'total_pinjam' => Transaksi::whereBetween('tanggal_pinjam', [$start, $end])->count(),
            'total_kembali' => Transaksi::whereBetween('tanggal_dikembalikan', [$start, $end])->count(),
            'terlambat' => Transaksi::whereNull('tanggal_dikembalikan')
                ->where('tanggal_kembali', '<', now())
                ->count(),
        ];
    }

    protected function getViewData(): array
    {
        return [
            'stats' => $this->getStats(),
        ];
    }
    
    public function printLaporan()
    {
        // In a real app, this would generate a PDF. 
        // For now, we'll trigger a browser print of a simplified view.
        $this->js('window.print()');
    }
}
