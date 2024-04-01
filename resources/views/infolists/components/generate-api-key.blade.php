<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div>
       <x-filament::button wire:loading.target="generateApiToken" wire:click="generateApiToken">Gerar</x-filament::button>
    </div>
</x-dynamic-component>