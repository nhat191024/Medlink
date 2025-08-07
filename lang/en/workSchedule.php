<?php
return [
    'work_schedule' => 'Work Schedule',

    'fields' => [
        'day_of_week' => 'Day of Week',
        'start_time' => 'Start Time',
        'end_time' => 'End Time',
        'all_day' => 'All Day',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
    ],

    'days' => [
        'sunday' => 'Sunday',
        'monday' => 'Monday',
        'tuesday' => 'Tuesday',
        'wednesday' => 'Wednesday',
        'thursday' => 'Thursday',
        'friday' => 'Friday',
        'saturday' => 'Saturday',
    ],

    'validation' => [
        'time_required_when_not_all_day' => 'Start time and end time are required when not selecting all day.',
    ],
];
