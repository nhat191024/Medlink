<?php

namespace App\Filament\Doctor\Resources;

use App\Models\Review;

use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Resources\Resource;

use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;

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

use App\Filament\Doctor\Resources\ReviewResource\RelationManagers;
use App\Filament\Doctor\Resources\ReviewResource\Pages\EditReview;
use App\Filament\Doctor\Resources\ReviewResource\Pages\ListReviews;
use App\Filament\Doctor\Resources\ReviewResource\Pages\CreateReview;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    public static function getNavigationGroup(): string
    {
        return __('sidebar.admin.appointment_management');
    }

    public static function getNavigationLabel(): string
    {
        return __('review.review');
    }

    public static function getPluralModelLabel(): string
    {
        return __('review.review');
    }

    public static function getModelLabel(): string
    {
        return __('review.review');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(__('review.fields.id'))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('patient.user.name')
                    ->label(__('review.fields.patient'))
                    ->searchable(),
                TextColumn::make('appointment_id')
                    ->label(__('review.fields.appointment'))
                    ->numeric(),
                TextColumn::make('rate')
                    ->label(__('review.fields.rate'))
                    ->numeric()
                    ->sortable(),
                IconColumn::make('recommend')
                    ->label(__('review.fields.recommend'))
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label(__('review.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('review.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
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
            'index' => ListReviews::route('/'),
            // 'create' => CreateReview::route('/create'),
            // 'edit' => EditReview::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with([
                'patient',
                'patient.user',
                'appointment',
            ])
            ->whereHas('appointment', function (Builder $query) {
                $query->where('doctor_profile_id', Auth::user()->doctorProfile->id);
            })
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
