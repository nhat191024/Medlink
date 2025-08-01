<?php

namespace App\Livewire;

use App\Models\Hospital;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Joaopaulolndev\FilamentEditProfile\Concerns\HasSort;
use Filament\Notifications\Notification;

class HospitalProfileComponent extends Component implements HasForms
{
    use InteractsWithForms;
    use HasSort;

    public ?array $data = [];

    protected static int $sort = -1;

    public function mount(): void
    {
        /** @var Hospital $hospital */
        $hospital = Auth::guard('hospital')->user();
        $this->form->fill([
            'name' => $hospital->name,
            'address' => $hospital->address,
            'city' => $hospital->city,
            'ward' => $hospital->ward,
            'email' => $hospital->email,
            'phone' => $hospital->phone,
            'website' => $hospital->website,
            'description' => $hospital->description,
            'contract_start_date' => $hospital->contract_start_date,
            'contract_end_date' => $hospital->contract_end_date,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('common.basic_info'))
                    ->description(__('common.hospital_basic_info_description'))
                    ->aside()
                    ->schema([
                        FileUpload::make('logo')
                            ->label(__('filament-edit-profile::default.avatar'))
                            ->avatar()
                            ->imageEditor()
                            ->directory('uploads/hospitals/logos'),
                        TextInput::make('name')
                            ->label(__('common.admin.hospital_name'))
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label(__('common.admin.phone'))
                            ->tel()
                            ->maxLength(20),
                        TextInput::make('website')
                            ->label(__('common.admin.website'))
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://example.com'),
                    ]),

                Section::make(__('common.admin.address'))
                    ->description(__('common.address_info_description'))
                    ->aside()
                    ->schema([
                        TextInput::make('address')
                            ->label(__('common.admin.address'))
                            ->required()
                            ->maxLength(255),

                        TextInput::make('ward')
                            ->label(__('common.admin.ward'))
                            ->required()
                            ->maxLength(255),

                        TextInput::make('city')
                            ->label(__('common.admin.city'))
                            ->required()
                            ->maxLength(255),
                    ]),

                Section::make(__('common.description_info'))
                    ->description(__('common.hospital_description_details'))
                    ->aside()
                    ->schema([
                        Textarea::make('description')
                            ->label('Mô tả')
                            ->rows(4)
                            ->maxLength(1000),
                    ]),

                Section::make(__('common.contact_info'))
                    ->description(__('common.contact_info_description'))
                    ->aside()
                    ->schema([
                        DatePicker::make('contract_start_date')
                            ->label(__('common.admin.contract_start_date'))
                            ->disabled()
                            ->dehydrated(false),

                        DatePicker::make('contract_end_date')
                            ->label(__('common.admin.contract_end_date'))
                            ->disabled()
                            ->dehydrated(false),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        /** @var Hospital $hospital */
        $hospital = Auth::guard('hospital')->user();

        $hospital->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'website' => $data['website'],
            'address' => $data['address'],
            'ward' => $data['ward'],
            'city' => $data['city'],
            'description' => $data['description'],
        ]);

        Notification::make()
            ->title(__('common.success'))
            ->body(__('common.notifation.update_success', ['name' => $hospital->name]))
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.hospital-profile-component');
    }
}
