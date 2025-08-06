<div>
    <form wire:submit="save">
        {{ $this->form }}

        <div class="mt-6">
            <x-filament::button type="submit" size="sm">
                {{ __('common.save') }}
            </x-filament::button>
        </div>
    </form>

    <x-filament-actions::modals />
</div>