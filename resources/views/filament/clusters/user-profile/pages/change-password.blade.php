<x-filament-panels::page>
    <form wire:submit="submit">
        <div class="mx-auto max-w-2xl space-y-8 lg:mx-0 lg:max-w-none">
            {{ $this->form }}

            <div class="flex justify-end">
                <x-filament::button type="submit" form="submit">
                    Atualizar dados
                </x-filament::button>
            </div>
        </div>
    </form>
</x-filament-panels::page>