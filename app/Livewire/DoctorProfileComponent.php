<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\DoctorProfile;
use App\Models\MedicalCategory;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Joaopaulolndev\FilamentEditProfile\Concerns\HasSort;
use Filament\Notifications\Notification;

class DoctorProfileComponent extends Component implements HasForms
{
    use InteractsWithForms;
    use HasSort;

    public ?array $data = [];

    protected static int $sort = -1;

    public function mount(): void
    {
        /** @var User $user */
        $user = Auth::user();
        $doctorProfile = $user->doctorProfile;

        $this->form->fill([
            // User fields
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'gender' => $user->gender,
            'country' => $user->country,
            'city' => $user->city,
            'ward' => $user->ward,
            'address' => $user->address,
            'avatar' => $user->avatar,

            // Doctor profile fields
            'professional_number' => $doctorProfile?->professional_number,
            'introduce' => $doctorProfile?->introduce,
            'medical_category_id' => $doctorProfile?->medical_category_id,
            'office_address' => $doctorProfile?->office_address,
            'company_name' => $doctorProfile?->company_name,
            'id_card_path' => $doctorProfile?->id_card_path,
            'medical_degree_path' => $doctorProfile?->medical_degree_path,
            'professional_card_path' => $doctorProfile?->professional_card_path,
            'exploitation_license_path' => $doctorProfile?->exploitation_license_path,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('common.basic_info'))
                    ->description('Thông tin cơ bản của bác sĩ')
                    ->aside()
                    ->schema([
                        FileUpload::make('avatar')
                            ->label(__('filament-edit-profile::default.avatar'))
                            ->avatar()
                            ->imageEditor()
                            ->directory('uploads/doctors/avatars')
                            ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/webp']),

                        TextInput::make('name')
                            ->label('Họ và tên')
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

                        Select::make('gender')
                            ->label('Giới tính')
                            ->options([
                                'male' => 'Nam',
                                'female' => 'Nữ',
                                'other' => 'Khác',
                            ])
                            ->native(false),
                    ]),

                Section::make(__('common.admin.address'))
                    ->description(__('common.address_info_description'))
                    ->aside()
                    ->schema([
                        TextInput::make('address')
                            ->label(__('common.admin.address'))
                            ->maxLength(255)
                            ->disabled(),

                        TextInput::make('ward')
                            ->label(__('common.admin.ward'))
                            ->maxLength(255)
                            ->disabled(),

                        TextInput::make('city')
                            ->label(__('common.admin.city'))
                            ->maxLength(255)
                            ->disabled(),

                        TextInput::make('country')
                            ->label(__('common.admin.country'))
                            ->maxLength(255)
                            ->disabled(),
                    ]),

                Section::make('Thông tin chuyên môn')
                    ->description('Thông tin nghề nghiệp và chuyên môn của bác sĩ')
                    ->aside()
                    ->schema([
                        TextInput::make('professional_number')
                            ->label('Số chứng chỉ hành nghề')
                            ->maxLength(255)
                            ->disabled(),

                        Select::make('medical_category_id')
                            ->label('Chuyên khoa')
                            ->options(MedicalCategory::pluck('name', 'id'))
                            ->searchable()
                            ->disabled(),

                        TextInput::make('company_name')
                            ->label('Tên công ty/Bệnh viện')
                            ->maxLength(255),

                        Textarea::make('introduce')
                            ->label('Giới thiệu bản thân')
                            ->rows(4)
                            ->maxLength(1000),
                    ]),

                Section::make('Tài liệu')
                    ->description('Các tài liệu chứng minh năng lực và pháp lý')
                    ->aside()
                    ->schema([
                        FileUpload::make('id_card_path')
                            ->label('CMND/CCCD')
                            ->directory('uploads/doctors/documents')
                            ->acceptedFileTypes(['image/*', 'application/pdf'])
                            ->disabled(),

                        FileUpload::make('medical_degree_path')
                            ->label('Bằng tốt nghiệp Y khoa')
                            ->directory('uploads/doctors/documents')
                            ->acceptedFileTypes(['image/*', 'application/pdf'])
                            ->disabled(),

                        FileUpload::make('professional_card_path')
                            ->label('Chứng chỉ hành nghề')
                            ->directory('uploads/doctors/documents')
                            ->acceptedFileTypes(['image/*', 'application/pdf'])
                            ->disabled(),

                        FileUpload::make('exploitation_license_path')
                            ->label('Giấy phép hoạt động')
                            ->directory('uploads/doctors/documents')
                            ->acceptedFileTypes(['image/*', 'application/pdf'])
                            ->disabled(),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        /** @var User $user */
        $user = Auth::user();

        // Update user information
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'avatar' => $data['avatar'],
        ]);

        // Update or create doctor profile
        $doctorProfileData = [
            'introduce' => $data['introduce'],
            'company_name' => $data['company_name'],
        ];

        $user->doctorProfile()->updateOrCreate(
            ['user_id' => $user->id],
            $doctorProfileData
        );

        Notification::make()
            ->title(__('common.success'))
            ->body(__('common.notifation.update_success', ['name' => $user->name]))
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.doctor-profile-component');
    }
}
