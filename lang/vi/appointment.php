<?php
return [
    'appointment' => 'Cuộc hẹn',
    'appointments' => 'Các cuộc hẹn',

    'fields' => [
        'patient' => 'Bệnh nhân',
        'doctor' => 'Bác sĩ',
        'service' => 'Dịch vụ',
        'status' => 'Trạng thái',
        'duration' => 'Thời gian',
        'medical_problem' => 'Vấn đề y tế',
        'medical_problem_file' => 'Tệp vấn đề y tế',
        'date' => 'Ngày',
        'day_of_week' => 'Ngày trong tuần',
        'time' => 'Mốc thời gian',
        'reason' => 'Lý do',
        'link' => 'Liên kết',
        'address' => 'Địa chỉ',
        'bill_id' => 'ID hóa đơn',
        'created_at' => 'Ngày tạo',
        'updated_at' => 'Ngày cập nhật',
    ],

    'status' => [
        'cancelled' => 'Đã hủy',
        'rejected' => 'Đã từ chối',
        'pending' => 'Đang chờ',
        'upcoming' => 'Sắp tới',
        'completed' => 'Đã hoàn thành',
    ],

    'actions' => [
        'change_status' => 'Thay đổi trạng thái',
        'view_exam_result' => 'Xem kết quả khám',
    ],

    'modals' => [
        'change_status' => [
            'title' => 'Thay đổi trạng thái cuộc hẹn',
            'description' => 'Bạn có chắc chắn muốn thay đổi trạng thái cuộc hẹn này không?',
            'status' => 'Trạng thái',
        ],

        'view_exam_result' => [
            'title' => 'Kết quả khám',
            'description' => 'Xem kết quả khám của cuộc hẹn này.',

            'fields' => [
                'patient' => 'Bệnh nhân',
                'doctor' => 'Bác sĩ',
                'service' => 'Dịch vụ',
                'date' => 'Ngày',
                'time' => 'Mốc thời gian',
                'exam_result' => 'Kết quả khám',
                'medical_information' => 'Thông tin y tế',
                'attachments' => 'Tệp đính kèm',
            ],

            'nothing' => 'Không có gì',
        ],
    ],
];
