<?php

namespace App\Filament\Admin\Resources;

use Spatie\Activitylog\Models\Activity;

use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Resources\Resource;

use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;

use Filament\Tables\Columns\TextColumn;

use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Filament\Resources\HospitalResource\RelationManagers;
use App\Filament\Admin\Resources\ActivityResource\Pages\EditActivity;
use App\Filament\Admin\Resources\ActivityResource\Pages\ListActivities;
use App\Filament\Admin\Resources\ActivityResource\Pages\CreateActivity;
use App\Models\Admin;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): string
    {
        return __('common.system');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.admin.activity');
    }

    public static function getModelLabel(): string
    {
        return __('common.admin.activity');
    }


    public static function table(Table $table): Table
    {
        return $table
            ->query(Activity::with(['subject', 'causer']))
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->sortable()
                    ->label(__('common.admin.id')),
                TextColumn::make('event')
                    ->searchable()
                    ->sortable()
                    ->label(__('common.admin.action')),
                TextColumn::make('subject_type')
                    ->searchable()
                    ->sortable()
                    ->label(__('common.admin.subject')),
                TextColumn::make('subject_id')
                    ->label(__('common.admin.subject_id')),
                TextColumn::make('subject_name')
                    ->searchable()
                    ->sortable()
                    ->label(__('common.admin.subject_name'))
                    ->getStateUsing(function ($record) {
                        if (!$record->subject_id) {
                            return 'N/A';
                        }
                        return $record->subject?->name ?? 'N/A';
                    }),
                TextColumn::make('causer_type')
                    ->searchable()
                    ->label(__('common.admin.causer'))
                    ->placeholder('N/A'),
                TextColumn::make('causer_id')
                    ->label(__('common.admin.causer_id'))
                    ->placeholder('N/A'),
                TextColumn::make('causer_name')
                    ->searchable()
                    ->label(__('common.admin.causer_name'))
                    ->getStateUsing(function ($record) {
                        if (!$record->causer_id) {
                            return 'N/A';
                        }
                        return $record->causer?->name ?? 'N/A';
                    }),
                TextColumn::make('created_at')
                    ->sortable()
                    ->label(__('common.admin.created_at')),
            ])
            ->filters([
                SelectFilter::make('event')
                    ->label(__('common.admin.action'))
                    ->options([
                        'created' => __('common.event.created'),
                        'updated' => __('common.event.updated'),
                        'deleted' => __('common.event.deleted'),
                        'restored' => __('common.event.restored'),
                        'force_deleted' => __('common.event.force_deleted'),
                    ]),
            ])
            ->actions([])
            ->bulkActions([
                //
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
            'index' => ListActivities::route('/'),
        ];
    }
}
