<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorResource\Pages;
use App\Filament\Resources\DoctorResource\RelationManagers;
use App\Models\User; // Chúng ta sẽ tạo User mới và profile cho họ
use App\Models\DoctorProfile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\FileUpload;

class DoctorResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'User Management';

    // Title hiển thị trong nav bar
    protected static ?string $navigationLabel = 'Bác sĩ';
    protected static ?string $pluralModelLabel = 'Bác sĩ';
    protected static ?string $modelLabel = 'Bác sĩ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Doctor Information')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Thông tin chung (User)')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Họ tên'),
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true) // Bỏ qua record hiện tại khi update
                                    ->label('Email'),
                                Forms\Components\TextInput::make('phone')
                                    ->tel()
                                    ->maxLength(255)
                                    ->label('Số điện thoại'),
                                Forms\Components\Select::make('country_code')
                                    ->options([
                                        '+84' => 'Việt Nam (+84)',
                                        '+1' => 'Hoa Kỳ (+1)',
                                        // Thêm các country code khác
                                    ])
                                    ->label('Mã vùng điện thoại'),
                                Forms\Components\TextInput::make('password')
                                    ->password()
                                    ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                                    ->dehydrated(fn(?string $state): bool => filled($state))
                                    ->required(fn(string $operation): bool => $operation === 'create')
                                    ->maxLength(255)
                                    ->label('Mật khẩu'),
                                Forms\Components\Select::make('user_type')
                                    ->options([
                                        'doctor' => 'Bác sĩ',
                                        'patient' => 'Bệnh nhân',
                                        'admin' => 'Quản trị viên',
                                    ])
                                    ->default('doctor') // Mặc định là bác sĩ
                                    ->required()
                                    ->native(false)
                                    ->label('Loại người dùng'),
                                Forms\Components\TextInput::make('address')
                                    ->maxLength(255)
                                    ->label('Địa chỉ'),
                                Forms\Components\TextInput::make('city')
                                    ->maxLength(255)
                                    ->label('Thành phố'),
                                Forms\Components\TextInput::make('state')
                                    ->maxLength(255)
                                    ->label('Tỉnh/Bang'),
                                Forms\Components\TextInput::make('zip_code')
                                    ->maxLength(255)
                                    ->label('Mã bưu chính'),
                                Forms\Components\TextInput::make('country')
                                    ->maxLength(255)
                                    ->label('Quốc gia'),
                                Forms\Components\Toggle::make('status')
                                    ->label('Trạng thái kích hoạt')
                                    ->default(true),
                                Forms\Components\TextInput::make('doctorProfile.professional_number')
                                    ->maxLength(255)
                                    ->label('Số chứng chỉ hành nghề'),
                            ]),

                        Forms\Components\Tabs\Tab::make('Thông tin hồ sơ bác sĩ (Doctor Profile)')
                            ->schema([

                                Forms\Components\Select::make('doctorProfile.medical_category_id')
                                    ->relationship('doctorProfile.medicalCategory', 'name')
                                    ->label('Chuyên khoa')
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\Textarea::make('doctorProfile.introduce')
                                    ->rows(5)
                                    ->maxLength(65535)
                                    ->columnSpanFull()
                                    ->label('Giới thiệu bản thân'),
                                Forms\Components\TextInput::make('doctorProfile.office_address')
                                    ->maxLength(255)
                                    ->label('Địa chỉ phòng khám'),
                                Forms\Components\TextInput::make('doctorProfile.company_name')
                                    ->maxLength(255)
                                    ->label('Tên công ty/Tổ chức'),
                                FileUpload::make('doctorProfile.id_card_path')
                                    ->directory('doctor_documents/id_cards')
                                    ->preserveFilenames() // Giữ nguyên tên file
                                    ->label('Ảnh CCCD/CMND'),
                                FileUpload::make('doctorProfile.medical_degree_path')
                                    ->directory('doctor_documents/medical_degrees')
                                    ->preserveFilenames()
                                    ->label('Ảnh bằng cấp y tế'),
                                FileUpload::make('doctorProfile.medical_license_path')
                                    ->directory('doctor_documents/medical_licenses')
                                    ->preserveFilenames()
                                    ->label('Ảnh giấy phép hành nghề'),
                            ])
                            ->columns(2), // Sắp xếp các field trong tab này thành 2 cột
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Họ tên'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label('Email'),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->label('Số điện thoại'),
                Tables\Columns\TextColumn::make('doctorProfile.professional_number') // Hiển thị từ bảng liên quan
                    ->label('Số chứng chỉ')
                    ->toggleable(isToggledHiddenByDefault: false) // Có thể ẩn/hiện
                    ->searchable(),
                Tables\Columns\TextColumn::make('doctorProfile.medicalCategory.name')
                    ->label('Chuyên khoa')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Trạng thái'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Ngày tạo'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Ngày cập nhật'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        true => 'Kích hoạt',
                        false => 'Không kích hoạt',
                    ])
                    ->label('Trạng thái'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctor::route('/create'),
            'edit' => Pages\EditDoctor::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_type', 'healthcare')
            ->where('identity', 'doctor')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
