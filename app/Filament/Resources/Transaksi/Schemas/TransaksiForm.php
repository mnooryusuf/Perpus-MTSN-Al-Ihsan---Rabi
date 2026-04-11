<?php

namespace App\Filament\Resources\Transaksi\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\Support\HtmlString;

class TransaksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_anggota')
                    ->label('Anggota')
                    ->relationship(
                        name: 'anggota',
                        titleAttribute: 'nis_nip',
                        modifyQueryUsing: fn ($query) => $query->join('user', 'anggota.user_id', '=', 'user.id')
                            ->select('anggota.*', 'user.name as user_name')
                    )
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->nis_nip} - {$record->user_name}")
                    ->searchable(['nis_nip', 'user.name'])
                    ->placeholder('Cari berdasarkan NIS/NIP atau Nama...')
                    ->autofocus()
                    ->live()
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        if (!$state) return;
                        $anggota = Anggota::find($state);
                        if (!$anggota) return;

                        if ($anggota->active_loans_count >= 3) {
                            \Filament\Notifications\Notification::make()
                                ->title('Peringatan: Limit Pinjaman')
                                ->body("Anggota ini sudah meminjam {$anggota->active_loans_count} buku. Maksimal adalah 3 buku.")
                                ->warning()
                                ->send();
                        }

                        // Set default due date based on role
                        $days = $anggota->user->role === 'guru' ? 14 : 7;
                        $set('tanggal_kembali', now()->addDays($days)->format('Y-m-d'));
                        
                        self::updateStatus($set, $get);
                    }),
                TextEntry::make('member_info')
                    ->label('Detail Anggota')
                    ->html()
                    ->state(function (callable $get) {
                        $id = $get('id_anggota');
                        if (!$id) return 'Silakan pilih anggota...';
                        $anggota = Anggota::find($id);
                        if (!$anggota) return 'Data tidak ditemukan.';

                        $role = ucfirst($anggota->user->role);
                        $loans = $anggota->active_loans_count;
                        $color = $loans >= 3 ? 'text-red-500' : 'text-green-500';

                        return new HtmlString("
                            <div class='flex flex-col gap-1'>
                                <span><strong>Nama:</strong> {$anggota->user->name} ({$role})</span>
                                <span><strong>Kelas:</strong> " . ($anggota->kelas ?? '-') . "</span>
                                <span><strong>Status Pinjaman:</strong> <span class='{$color}'>{$loans} / 3 Buku</span></span>
                            </div>
                        ");
                    })
                    ->visible(fn (callable $get) => $get('id_anggota')),

                Select::make('id_buku')
                    ->label('Buku')
                    ->relationship('buku', 'judul')
                    ->searchable()
                    ->live()
                    ->placeholder('Pilih buku yang dipinjam...')
                    ->required()
                    ->rules([
                        fn () => function (string $attribute, $value, \Closure $fail) {
                            if (!$value) return;
                            $buku = Buku::find($value);
                            if ($buku && $buku->available_stock <= 0) {
                                $fail('Maaf, stok buku ini sedang habis.');
                            }
                        },
                    ]),
                TextEntry::make('book_info')
                    ->label('Stok Buku')
                    ->html()
                    ->state(function (callable $get) {
                        $id = $get('id_buku');
                        if (!$id) return 'Silakan pilih buku...';
                        $buku = Buku::find($id);
                        if (!$buku) return 'Data tidak ditemukan.';

                        $stock = $buku->available_stock;
                        $color = $stock <= 0 ? 'text-red-500' : 'text-blue-500';

                        return new HtmlString("
                            <div><strong>Sisa Stok:</strong> <span class='font-bold {$color}'>{$stock} Eksemplar</span></div>
                        ");
                    })
                    ->visible(fn (callable $get) => $get('id_buku')),

                Select::make('id_user')
                    ->label('Pustakawan')
                    ->relationship('pustakawan', 'name')
                    ->default(\Illuminate\Support\Facades\Auth::id())
                    ->disabled()
                    ->dehydrated()
                    ->required(),
                DatePicker::make('tanggal_pinjam')
                    ->label('Tanggal Pinjam')
                    ->default(now())
                    ->required(),
                DatePicker::make('tanggal_kembali')
                    ->label('Tanggal Kembali')
                    ->default(now()->addDays(7))
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn (callable $set, callable $get) => self::updateStatus($set, $get)),
                DatePicker::make('tanggal_dikembalikan')
                    ->label('Tanggal Dikembalikan')
                    ->live()
                    ->hiddenOn('create')
                    ->afterStateHydrated(function (callable $set, callable $get, $state) {
                        // On Edit mode, if it's empty, default to today
                        if (!$state && $get('id_anggota')) {
                            $set('tanggal_dikembalikan', now()->format('Y-m-d'));
                        }
                    })
                    ->afterStateUpdated(fn (callable $set, callable $get) => self::updateStatus($set, $get)),
                TextEntry::make('status_preview')
                    ->label('Status Otomatis')
                    ->state(fn (callable $get) => ucfirst($get('status') ?? 'dipinjam'))
                    ->extraAttributes(['class' => 'font-bold text-primary-600']),
                \Filament\Forms\Components\Hidden::make('status')
                    ->default('dipinjam')
                    ->required(),
            ]);
    }

    protected static function updateStatus(callable $set, callable $get): void
    {
        $kembali = $get('tanggal_kembali');
        $dikembalikan = $get('tanggal_dikembalikan');
        
        if ($dikembalikan) {
            $set('status', 'dikembalikan');
            return;
        }

        if ($kembali && \Illuminate\Support\Carbon::parse($kembali)->isPast() && !\Illuminate\Support\Carbon::parse($kembali)->isToday()) {
            $set('status', 'terlambat');
        } else {
            $set('status', 'dipinjam');
        }
    }
}
