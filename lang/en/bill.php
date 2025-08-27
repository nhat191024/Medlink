<?php
return [
    'bill' => 'Bill',
    'fields' => [
        'id' => 'ID',
        'appointment_id' => 'Appointment ID',
        'payment_method' => 'Payment Method',
        'taxVAT' => 'Tax/VAT',
        'total' => 'Total',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
    ],

    'payment_methods' => [
        'wallet' => 'Wallet',
        'credit_card' => 'Credit Card',
        'qr_transfer' => 'QR Transfer',
    ],

    'statuses' => [
        'pending' => 'Pending',
        'paid' => 'Paid',
        'cancelled' => 'Cancelled',
        'refunded' => 'Refunded',
    ],
];
