<?php
return [
    'bill' => 'Hóa đơn',
    'fields' => [
        'id' => 'ID',
        'appointment_id' => 'ID cuộc hẹn',
        'payment_method' => 'Phương thức thanh toán',
        'taxVAT' => 'Thuế/VAT',
        'total' => 'Tổng cộng',
        'status' => 'Trạng thái',
        'created_at' => 'Ngày tạo',
        'updated_at' => 'Ngày cập nhật',
    ],

    'payment_methods' => [
        'wallet' => 'Ví điện tử',
        'credit_card' => 'Thẻ tín dụng',
        'qr_transfer' => 'Chuyển khoản qua QR',
    ],

    'statuses' => [
        'pending' => 'Đang chờ',
        'paid' => 'Đã thanh toán',
        'cancelled' => 'Đã hủy',
        'refunded' => 'Đã hoàn tiền',
    ],
];
