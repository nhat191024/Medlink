<?php
return [
    'work_schedule' => 'Lịch làm việc',

    'fields' => [
        'day_of_week' => 'Ngày trong tuần',
        'start_time' => 'Giờ bắt đầu',
        'end_time' => 'Giờ kết thúc',
        'all_day' => 'Cả ngày',
        'created_at' => 'Ngày tạo',
        'updated_at' => 'Ngày cập nhật',
    ],

    'days' => [
        'sunday' => 'Chủ nhật',
        'monday' => 'Thứ hai',
        'tuesday' => 'Thứ ba',
        'wednesday' => 'Thứ tư',
        'thursday' => 'Thứ năm',
        'friday' => 'Thứ sáu',
        'saturday' => 'Thứ bảy',
    ],

    'validation' => [
        'time_required_when_not_all_day' => 'Thời gian bắt đầu và kết thúc không được để trống khi không chọn cả ngày.',
    ],
];
