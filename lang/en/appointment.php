<?php
return [
    'appointment' => 'Appointment',
    'appointments' => 'Appointments',

    'fields' => [
        'patient' => 'Patient',
        'doctor' => 'Doctor',
        'service' => 'Service',
        'status' => 'Status',
        'date' => 'Date',
        'duration' => 'Duration',
        'day_of_week' => 'Day of Week',
        'medical_problem' => 'Medical Problem',
        'medical_problem_file' => 'Medical Problem File',
        'time' => 'Time',
        'reason' => 'Reason',
        'link' => 'Link',
        'address' => 'Address',
    ],

    'status' => [
        'cancelled' => 'Cancelled',
        'rejected' => 'Rejected',
        'pending' => 'Pending',
        'upcoming' => 'Upcoming',
        'completed' => 'Completed',
    ],

    'actions' => [
        'change_status' => 'Change Status',
    ],

    'modals' => [
        'change_status' => [
            'title' => 'Change Appointment Status',
            'description' => 'Are you sure you want to change the status of this appointment?',
            'status' => 'Status',
        ],
    ],
];
