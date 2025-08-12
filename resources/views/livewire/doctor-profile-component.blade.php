<div>
    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}

        <div class="fi-form-actions">
            <div class="fi-ac flex flex-row-reverse flex-wrap items-center gap-3">
                <x-filament::button type="submit">
                    {{ __('filament-edit-profile::default.save') }}
                </x-filament::button>
            </div>
        </div>
    </x-filament-panels::form>

    <x-filament-actions::modals />
</div>
