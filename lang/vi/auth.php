<?php
return [
    'validation' => [
        'required' => ':attribute là bắt buộc.',
        'email' => ':attribute phải là một địa chỉ email hợp lệ.',
        'min' => ':attribute phải có ít nhất :min ký tự.',
        'max' => ':attribute không được vượt quá :max ký tự.',
        'confirmed' => 'Xác nhận :attribute không khớp.',
        'unique' => ':attribute đã được sử dụng.',
        'exists' => ':attribute không tồn tại.',
        'numeric' => ':attribute phải là một số.',
        'string' => ':attribute phải là một chuỗi.',
        'boolean' => ':attribute phải là đúng hoặc sai.',
        'date' => ':attribute không phải là một ngày hợp lệ.',
        'array' => ':attribute phải là một mảng.',
        'file' => ':attribute phải là một tệp.',
        'image' => ':attribute phải là một hình ảnh.',
        'mimes' => ':attribute phải là một tệp loại: :values.',
        'dimensions' => ':attribute có kích thước hình ảnh không hợp lệ.',
        'timezone' => ':attribute phải là một múi giờ hợp lệ.',
        'in' => ':attribute phải là một trong các giá trị sau: :values.',
        'not_in' => ':attribute không được là một trong các giá trị sau: :values.',
        'regex' => ':attribute có định dạng không hợp lệ.',
        'url' => ':attribute phải là một URL hợp lệ.',
    ],

    'login' => [
        'success' => 'Đăng nhập thành công.',
        'failed' => 'Đăng nhập thất bại. Vui lòng kiểm tra thông tin đăng nhập của bạn.',
        'throttle' => 'Quá nhiều lần đăng nhập không thành công. Vui lòng thử lại sau :seconds giây.',
    ],

    'registration' => [
        'success' => 'Đăng ký thành công. Vui lòng kiểm tra email của bạn để xác minh.',
        'failed' => 'Đăng ký thất bại. Vui lòng thử lại sau.',
        'email_verification' => 'Vui lòng xác minh địa chỉ email của bạn để hoàn tất đăng ký.',
        'invalid_insurance' => 'Loại bảo hiểm đã chọn không hợp lệ.',
        'invalid_identity' => 'Danh tính đã chọn không hợp lệ.',
    ],

    'status' => [
        'suspended' => 'Tài khoản của bạn đã bị tạm ngưng. Vui lòng liên hệ với quản trị viên để biết thêm chi tiết.',
        'not_approved' => 'Tài khoản của bạn chưa được phê duyệt. Vui lòng đợi quản trị viên phê duyệt.',
    ]
];
