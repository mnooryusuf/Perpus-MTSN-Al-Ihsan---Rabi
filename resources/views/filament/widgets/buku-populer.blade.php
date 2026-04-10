<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #d9a938;"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <span>Buku Paling Populer</span>
            </div>
        </x-slot>

        @php
            $bukuPopuler = $this->getBukuPopuler();
            $maxPeminjaman = $this->getMaxPeminjaman();
            $medals = ['🥇', '🥈', '🥉', '4', '5'];
            $barColors = ['#d9a938', '#a8a8a8', '#cd7f32', '#6b7280', '#6b7280'];
        @endphp

        @if($bukuPopuler->isEmpty())
            <div style="text-align: center; padding: 2rem; color: #9ca3af;">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 0.75rem; opacity: 0.5;"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/></svg>
                <p style="margin: 0; font-weight: 500;">Belum ada data peminjaman</p>
            </div>
        @else
            <div class="buku-populer-list">
                @foreach($bukuPopuler as $index => $buku)
                    <div class="buku-populer-item">
                        <div class="buku-rank">
                            @if($index < 3)
                                <span style="font-size: 1.4rem;">{{ $medals[$index] }}</span>
                            @else
                                <span class="buku-rank-number">{{ $index + 1 }}</span>
                            @endif
                        </div>
                        <div class="buku-info">
                            <div class="buku-title-row">
                                <span class="buku-judul">{{ $buku->judul }}</span>
                                <span class="buku-count">{{ $buku->transaksis_count }}x dipinjam</span>
                            </div>
                            <div class="buku-penulis">{{ $buku->penulis }} · {{ $buku->kategori }}</div>
                            <div class="buku-bar-wrapper">
                                <div class="buku-bar" style="width: {{ $maxPeminjaman > 0 ? ($buku->transaksis_count / $maxPeminjaman) * 100 : 0 }}%; background: {{ $barColors[$index] ?? '#6b7280' }};"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </x-filament::section>

    <style>
        .buku-populer-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .buku-populer-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 0.75rem;
            border-radius: 12px;
            transition: background 0.2s;
        }

        .buku-populer-item:hover {
            background: rgba(0, 0, 0, 0.02);
        }

        .dark .buku-populer-item:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        .buku-rank {
            flex-shrink: 0;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .buku-rank-number {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: #6b7280;
        }

        .dark .buku-rank-number {
            background: rgba(255, 255, 255, 0.1);
            color: #9ca3af;
        }

        .buku-info {
            flex: 1;
            min-width: 0;
        }

        .buku-title-row {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .buku-judul {
            font-weight: 600;
            font-size: 0.9rem;
            color: #111827;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .dark .buku-judul {
            color: #f9fafb;
        }

        .buku-count {
            flex-shrink: 0;
            font-size: 0.75rem;
            font-weight: 600;
            color: #d9a938;
            background: rgba(217, 169, 56, 0.1);
            padding: 0.15rem 0.5rem;
            border-radius: 100px;
        }

        .buku-penulis {
            font-size: 0.78rem;
            color: #9ca3af;
            margin-top: 0.15rem;
        }

        .buku-bar-wrapper {
            margin-top: 0.5rem;
            height: 6px;
            background: #f3f4f6;
            border-radius: 100px;
            overflow: hidden;
        }

        .dark .buku-bar-wrapper {
            background: rgba(255, 255, 255, 0.08);
        }

        .buku-bar {
            height: 100%;
            border-radius: 100px;
            transition: width 1s ease;
            min-width: 4px;
        }
    </style>
</x-filament-widgets::widget>
