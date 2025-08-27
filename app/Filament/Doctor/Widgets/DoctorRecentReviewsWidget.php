<?php

namespace App\Filament\Doctor\Widgets;

use App\Models\Review;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class DoctorRecentReviewsWidget extends BaseWidget
{
    protected static ?string $heading = 'Đánh giá gần đây';

    protected static ?int $sort = 6;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $doctorId = Auth::user()->doctorProfile->id;

        return $table
            ->query(
                Review::query()
                    ->with([
                        'patient.user:id,name,avatar',
                        'appointment:id,date,time'
                    ])
                    ->where('doctor_profile_id', $doctorId)
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('patient.user.avatar')
                    ->label('Avatar')
                    ->circular()
                    ->defaultImageUrl('/images/default-avatar.png'),

                Tables\Columns\TextColumn::make('patient.user.name')
                    ->label('Bệnh nhân')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('rate')
                    ->label('Điểm đánh giá')
                    ->formatStateUsing(fn($state) => $state . '/5 ⭐')
                    ->badge()
                    ->color(fn($state) => $state >= 4 ? 'success' : ($state >= 3 ? 'warning' : 'danger')),

                Tables\Columns\IconColumn::make('recommend')
                    ->label('Khuyến nghị')
                    ->boolean(),

                Tables\Columns\TextColumn::make('review')
                    ->label('Nội dung')
                    ->limit(50)
                    ->wrap(),

                Tables\Columns\TextColumn::make('appointment.date')
                    ->label('Ngày khám')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Được tạo')
                    ->since()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Xem chi tiết')
                    ->icon('heroicon-m-eye')
                    ->modalContent(
                        fn(Review $record) =>
                        view('filament.components.review-detail', ['review' => $record])
                    )
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Đóng'),
            ])
            ->paginated(false);
    }
}
