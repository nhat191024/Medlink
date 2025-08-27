<?php

namespace App\Filament\Doctor\Widgets;

use App\Models\Appointment;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class DoctorRecentActivitiesWidget extends BaseWidget
{
    protected static ?string $heading = 'Hoạt động gần đây';

    protected static ?int $sort = 7;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $doctorId = Auth::user()->doctorProfile->id;

        return $table
            ->query(
                Appointment::query()
                    ->with([
                        'patient.user:id,name,email,avatar',
                        'service:id,name,price',
                        'patient:id,user_id'
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

                Tables\Columns\TextColumn::make('service.name')
                    ->label('Dịch vụ')
                    ->limit(30),

                Tables\Columns\TextColumn::make('date')
                    ->label('Ngày hẹn')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('time')
                    ->label('Giờ hẹn'),

                Tables\Columns\TextColumn::make('service.price')
                    ->label('Giá dịch vụ')
                    ->money('VND'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => 'Chờ xác nhận',
                        'confirmed' => 'Đã xác nhận',
                        'completed' => 'Hoàn thành',
                        'cancelled' => 'Đã hủy',
                        'rejected' => 'Bị từ chối',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Được tạo')
                    ->since()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('update_status')
                    ->label('Cập nhật')
                    ->icon('heroicon-m-pencil-square')
                    ->form([
                        \Filament\Forms\Components\Select::make('status')
                            ->label('Trạng thái')
                            ->options([
                                'pending' => 'Chờ xác nhận',
                                'confirmed' => 'Đã xác nhận',
                                'completed' => 'Hoàn thành',
                                'cancelled' => 'Đã hủy',
                                'rejected' => 'Bị từ chối',
                            ])
                            ->native(false)
                            ->required(),
                    ])
                    ->action(function (array $data, Appointment $record): void {
                        $record->update(['status' => $data['status']]);
                    })
                    ->visible(
                        fn(Appointment $record): bool =>
                        in_array($record->status, ['pending', 'confirmed'])
                    ),
            ])
            ->paginated(false);
    }
}
