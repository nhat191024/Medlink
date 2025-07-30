<?php

namespace App\Filament\Admin\Resources;

use App\Models\MedicalCategory;

use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Resources\Resource;

// use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;

use Filament\Tables\Columns\TextColumn;

use Filament\Forms\Components\TextInput;

// use Filament\Tables\Actions\Action;
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

// use App\Filament\Resources\MedicalCategoryResource\RelationManagers;
use App\Filament\Admin\Resources\MedicalCategoryResource\Pages\EditMedicalCategory;
use App\Filament\Admin\Resources\MedicalCategoryResource\Pages\ListMedicalCategories;
use App\Filament\Admin\Resources\MedicalCategoryResource\Pages\CreateMedicalCategory;

class MedicalCategoryResource extends Resource
{
    protected static ?string $model = MedicalCategory::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    // public static function getNavigationGroup(): string
    // {
    //     return __('sidebar.admin.medical_category');
    // }

    public static function getNavigationLabel(): string
    {
        return __('medicalCategory.medical_category');
    }

    public static function getPluralModelLabel(): string
    {
        return __('medicalCategory.medical_category');
    }

    public static function getModelLabel(): string
    {
        return __('medicalCategory.medical_category');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('medicalCategory.fields.name'))
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make()
                    ->native(false)
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
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
            'index' => ListMedicalCategories::route('/'),
            // 'create' => CreateMedicalCategory::route('/create'),
            // 'edit' => EditMedicalCategory::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
