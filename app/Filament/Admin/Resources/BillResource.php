<?php

namespace App\Filament\Admin\Resources;

use App\Models\Bill;

use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Resources\Resource;

use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;

use Filament\Tables\Columns\TextColumn;

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

use App\Filament\Admin\Resources\BillResource\RelationManagers;
use App\Filament\Admin\Resources\BillResource\Pages\EditBill;
use App\Filament\Admin\Resources\BillResource\Pages\ListBills;
use App\Filament\Admin\Resources\BillResource\Pages\CreateBill;

class BillResource extends Resource
{
    protected static ?string $model = Bill::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getNavigationGroup(): string
    {
        return __('sidebar.admin.appointment_management');
    }

    public static function getNavigationLabel(): string
    {
        return __('bill.bill');
    }

    public static function getPluralModelLabel(): string
    {
        return __('bill.bill');
    }

    public static function getModelLabel(): string
    {
        return __('bill.bill');
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
                    ->label(__('bill.fields.id'))
                    ->searchable(),
                TextColumn::make('appointment_id')
                    ->label(__('bill.fields.appointment_id'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->label(__('bill.fields.payment_method'))
                    ->badge()
                    ->state(fn($record): string => $record->payment_method)
                    ->formatStateUsing(fn(string $state): string => [
                        'wallet' => __('bill.payment_methods.wallet'),
                        'credit_card' => __('bill.payment_methods.credit_card'),
                        'qr_transfer' => __('bill.payment_methods.qr_transfer'),
                    ][$state] ?? $state)
                    ->color(fn(string $state): string => [
                        'wallet' => 'success',
                        'credit_card' => 'primary',
                        'qr_transfer' => 'info',
                    ][$state] ?? 'secondary')
                    ->icon(fn(string $state): string => [
                        'wallet' => 'heroicon-o-wallet',
                        'credit_card' => 'heroicon-o-credit-card',
                        'qr_transfer' => 'heroicon-o-qr-code',
                    ][$state] ?? 'heroicon-o-question-mark-circle'),
                TextColumn::make('taxVAT')
                    ->label(__('bill.fields.taxVAT'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total')
                    ->label(__('bill.fields.total'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->label(__('bill.fields.status'))
                    ->badge()
                    ->state(fn($record): string => $record->status)
                    ->formatStateUsing(fn(string $state): string => [
                        'cancelled' => __('bill.statuses.cancelled'),
                        'refunded' => __('bill.statuses.refunded'),
                        'pending' => __('bill.statuses.pending'),
                        'paid' => __('bill.statuses.paid'),
                    ][$state] ?? $state)
                    ->color(fn(string $state): string => [
                        'cancelled' => 'danger',
                        'refunded' => 'danger',
                        'pending' => 'warning',
                        'paid' => 'success',
                    ][$state] ?? 'secondary')
                    ->icon(fn(string $state): string => [
                        'cancelled' => 'heroicon-o-x-circle',
                        'refunded' => 'heroicon-o-arrow-uturn-left',
                        'pending' => 'heroicon-o-clock',
                        'paid' => 'heroicon-o-check-circle',
                    ][$state] ?? 'heroicon-o-question-mark-circle'),
                TextColumn::make('created_at')
                    ->label(__('bill.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('bill.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label(__('bill.fields.status'))
                    ->native(false)
                    ->options([
                        'pending' => __('bill.statuses.pending'),
                        'paid' => __('bill.statuses.paid'),
                        'cancelled' => __('bill.statuses.cancelled'),
                        'refunded' => __('bill.statuses.refunded'),
                    ]),
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
            'index' => ListBills::route('/'),
            // 'create' => CreateBill::route('/create'),
            // 'edit' => EditBill::route('/{record}/edit'),
        ];
    }
}
