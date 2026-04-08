<x-filament-panels::page>
    <div>
        <form wire:submit="save">
            {{ $this->form }}

            <div style="margin-top:1.5rem;">
                <x-filament::button type="submit" icon="heroicon-m-check" size="lg">
                    Simpan Pengaturan
                </x-filament::button>
            </div>
        </form>
    </div>

    <x-filament-actions::modals />
</x-filament-panels::page>
