<?php

namespace App\Filament\Resources;

use App\Models\User;

use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Resources\Resource;

use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;

use Filament\Tables\Columns\TextColumn;

use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Filament\Resources\DoctorResource\RelationManagers;
use App\Filament\Resources\DoctorResource\Pages\EditDoctor;
use App\Filament\Resources\DoctorResource\Pages\ListDoctors;
use App\Filament\Resources\DoctorResource\Pages\CreateDoctor;


class DoctorResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'User Management';

    protected static ?string $navigationLabel = 'Bác sĩ';
    protected static ?string $pluralModelLabel = 'Bác sĩ';
    protected static ?string $modelLabel = 'Bác sĩ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //no need form because admin cannot add / edit doctor
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Họ tên'),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label('Email'),
                TextColumn::make('phone')
                    ->searchable()
                    ->label('Số điện thoại'),
                TextColumn::make('country')
                    ->label('Quốc gia')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('city')
                    ->label('Thành phố')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('state')
                    ->label('Tỉnh/Thành phố')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('doctorProfile.professional_number')
                    ->label('Số chứng chỉ')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                TextColumn::make('doctorProfile.medicalCategory.name')
                    ->label('Chuyên khoa')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->state(function ($record): string {
                        if ($record->trashed()) {
                            return 'suspended';
                        }
                        return $record->status;
                    })
                    ->formatStateUsing(fn(string $state): string => [
                        'active' => 'Kích hoạt',
                        'waiting-approval' => 'Chờ duyệt',
                        'suspended' => 'Đình chỉ',
                    ][$state] ?? $state)
                    ->color(fn(string $state): string => [
                        'active' => 'success',
                        'waiting-approval' => 'warning',
                        'suspended' => 'danger',
                    ][$state] ?? 'secondary')
                    ->icon(fn(string $state): string => [
                        'active' => 'heroicon-o-check-circle',
                        'waiting-approval' => 'heroicon-o-clock',
                        'suspended' => 'heroicon-o-no-symbol',
                    ][$state] ?? 'heroicon-o-question-mark-circle'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Ngày tạo'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Ngày cập nhật'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'active' => 'Kích hoạt',
                        'waiting-approval' => 'Chờ duyệt',
                    ])
                    ->native(false)
                    ->label('Trạng thái'),
                TrashedFilter::make(),
            ])
            ->actions([
                Action::make('approve')
                    ->label('Duyệt')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (User $record) {
                        $record->status = 'active';
                        $record->save();
                    })
                    ->visible(fn(User $record): bool => $record->status === 'waiting-approval'),
                DeleteAction::make()
                    ->icon('heroicon-o-no-symbol')
                    ->label('Suspend')
                    ->requiresConfirmation()
                    ->modalHeading('Suspend Doctor')
                    ->modalDescription('Are you sure you want to suspend this doctor?')
                    ->successNotificationTitle('Doctor suspended successfully.'),
                RestoreAction::make()
                    ->icon('heroicon-o-arrow-path')
                    ->label('Restore')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Reactivate Doctor')
                    ->modalDescription('Are you sure you want to reactivate this doctor?')
                    ->successNotificationTitle('Doctor reactivate successfully.'),
                ForceDeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->label('Delete Permanently')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Delete Doctor Permanently')
                    ->modalDescription('Are you sure you want to delete this doctor permanently? This action cannot be undone.')
                    ->successNotificationTitle('Doctor deleted permanently.'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
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
            'index' => ListDoctors::route('/'),
            'create' => CreateDoctor::route('/create'),
            'edit' => EditDoctor::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_type', 'healthcare')
            ->where('identity', 'doctor')
            ->with([
                'doctorProfile',
                'doctorProfile.medicalCategory',
            ])
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
