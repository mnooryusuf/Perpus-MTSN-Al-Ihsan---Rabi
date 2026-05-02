<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use BackedEnum;
use UnitEnum;
use App\Models\Buku;
use App\Models\Transaksi;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
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
            'report_type' => 'peminjaman',
            'start_date' => now()->startOfMonth()->format('Y-m-d'),
            'end_date' => now()->endOfMonth()->format('Y-m-d'),
        ]);
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Section::make('Pilih Jenis Laporan')
                    ->description('Pilih jenis data yang ingin diekspor.')
                    ->schema([
                        Select::make('report_type')
                            ->label('Jenis Laporan')
                            ->options([
                                'buku'          => '📚 Laporan Data Buku',
                                'anggota'       => '👥 Laporan Data Anggota',
                                'peminjaman'    => '📤 Laporan Transaksi Peminjaman',
                                'pengembalian'  => '📥 Laporan Transaksi Pengembalian',
                            ])
                            ->required()
                            ->live()
                            ->default('peminjaman')
                            ->columnSpanFull(),
                        DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->live()
                            ->required()
                            ->visible(fn (callable $get) => in_array($get('report_type'), ['peminjaman', 'pengembalian'])),
                        DatePicker::make('end_date')
                            ->label('Tanggal Selesai')
                            ->live()
                            ->required()
                            ->visible(fn (callable $get) => in_array($get('report_type'), ['peminjaman', 'pengembalian'])),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    protected function getStats(): array
    {
        $start = $this->data['start_date'] ?? now()->startOfMonth();
        $end = $this->data['end_date'] ?? now()->endOfMonth();

        return [
            'total_buku'    => Buku::query()->sum('jumlah_eksemplar'),
            'total_pinjam'  => Transaksi::query()->whereBetween('tanggal_pinjam', [$start, $end], 'and', false)->count('*'),
            'total_kembali' => Transaksi::query()->whereBetween('tanggal_dikembalikan', [$start, $end], 'and', false)->count('*'),
            'terlambat'     => Transaksi::query()->whereNull('tanggal_dikembalikan', 'and', false)
                ->where('tanggal_kembali', '<', now())
                ->count('*'),
            'total_denda'   => Transaksi::query()->whereBetween('tanggal_dikembalikan', [$start, $end], 'and', false)
                ->where('denda', '>', 0)
                ->sum('denda'),
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
        $this->js('window.print()');
    }
}
