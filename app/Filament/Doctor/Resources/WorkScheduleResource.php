<?php

namespace App\Filament\Doctor\Resources;

use App\Models\WorkSchedule;

use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Resources\Resource;

use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TimePicker;

use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

use App\Filament\Doctor\Resources\WorkScheduleResource\RelationManagers;
use App\Filament\Doctor\Resources\WorkScheduleResource\Pages\EditWorkSchedule;
use App\Filament\Doctor\Resources\WorkScheduleResource\Pages\ListWorkSchedules;
use App\Filament\Doctor\Resources\WorkScheduleResource\Pages\CreateWorkSchedule;

class WorkScheduleResource extends Resource
{
    protected static ?string $model = WorkSchedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function getNavigationGroup(): string
    {
        return __('common.system');
    }

    public static function getNavigationLabel(): string
    {
        return __('workSchedule.work_schedule');
    }

    public static function getPluralModelLabel(): string
    {
        return __('workSchedule.work_schedule');
    }

    public static function getModelLabel(): string
    {
        return __('workSchedule.work_schedule');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('day_of_week')
                    ->label(__('workSchedule.fields.day_of_week'))
                    ->options([
                        'Sunday' => __('workSchedule.days.sunday'),
                        'Monday' => __('workSchedule.days.monday'),
                        'Tuesday' => __('workSchedule.days.tuesday'),
                        'Wednesday' => __('workSchedule.days.wednesday'),
                        'Thursday' => __('workSchedule.days.thursday'),
                        'Friday' => __('workSchedule.days.friday'),
                        'Saturday' => __('workSchedule.days.saturday'),
                    ])
                    ->native(false)
                    ->required()
                    ->columnSpanFull(),
                TimePicker::make('start_time')
                    ->label(__('workSchedule.fields.start_time'))
                    ->required(fn(callable $get) => !$get('all_day'))
                    ->disabled(fn(callable $get) => $get('all_day'))
                    ->dehydrated(fn(callable $get) => !$get('all_day')),
                TimePicker::make('end_time')
                    ->label(__('workSchedule.fields.end_time'))
                    ->required(fn(callable $get) => !$get('all_day'))
                    ->disabled(fn(callable $get) => $get('all_day'))
                    ->dehydrated(fn(callable $get) => !$get('all_day')),
                Toggle::make('all_day')
                    ->label(__('workSchedule.fields.all_day'))
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state) {
                        if ($state) {
                            $set('start_time', null);
                            $set('end_time', null);
                        }
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('day_of_week')
                    ->label(__('workSchedule.fields.day_of_week'))
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'Sunday' => __('workSchedule.days.sunday'),
                            'Monday' => __('workSchedule.days.monday'),
                            'Tuesday' => __('workSchedule.days.tuesday'),
                            'Wednesday' => __('workSchedule.days.wednesday'),
                            'Thursday' => __('workSchedule.days.thursday'),
                            'Friday' => __('workSchedule.days.friday'),
                            'Saturday' => __('workSchedule.days.saturday'),
                            default => $state,
                        };
                    })
                    ->sortable(),
                TextColumn::make('start_time')
                    ->label(__('workSchedule.fields.start_time'))
                    ->time()
                    ->placeholder('N/A'),
                TextColumn::make('end_time')
                    ->label(__('workSchedule.fields.end_time'))
                    ->time()
                    ->placeholder('N/A'),
                IconColumn::make('all_day')
                    ->label(__('workSchedule.fields.all_day'))
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label(__('workSchedule.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('workSchedule.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()
                    ->color('warning'),
                DeleteAction::make()
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => ListWorkSchedules::route('/'),
            // 'create' => CreateWorkSchedule::route('/create'),
            // 'edit' => EditWorkSchedule::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('doctor_profile_id', Auth::user()->doctorProfile->id)
            ->orderByRaw("FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')");
    }
}
