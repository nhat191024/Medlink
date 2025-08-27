<?php

namespace App\Filament\Doctor\Resources;

use App\Models\Service;

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

use App\Filament\Doctor\Resources\ServiceResource\RelationManagers;
use App\Filament\Doctor\Resources\ServiceResource\Pages\EditService;
use App\Filament\Doctor\Resources\ServiceResource\Pages\ListServices;
use App\Filament\Doctor\Resources\ServiceResource\Pages\CreateService;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function getNavigationGroup(): string
    {
        return __('common.system');
    }

    public static function getNavigationLabel(): string
    {
        return __('service.service');
    }

    public static function getPluralModelLabel(): string
    {
        return __('service.service');
    }

    public static function getModelLabel(): string
    {
        return __('service.service');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('service.fields.name'))
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->label(__('service.fields.description'))
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->label(__('service.fields.price'))
                    ->required()
                    ->numeric()
                    ->prefix('₫'),
                TextInput::make('duration')
                    ->label(__('service.fields.duration'))
                    ->required()
                    ->numeric(),
                Toggle::make('is_active')
                    ->label(__('service.fields.is_active'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('service.fields.name'))
                    ->searchable(),
                TextColumn::make('description')
                    ->label(__('service.fields.description'))
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('price')
                    ->label(__('service.fields.price'))
                    ->money('VND')
                    ->sortable(),
                TextColumn::make('duration')
                    ->label(__('service.fields.duration'))
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label(__('service.fields.is_active'))
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label(__('service.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('service.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
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
            'index' => ListServices::route('/'),
            // 'create' => CreateService::route('/create'),
            // 'edit' => EditService::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('doctor_profile_id', Auth::user()->doctorProfile->id);
    }
}
