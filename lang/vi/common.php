<?php
return [
    'admin' => [
        'id' => 'ID',

        'admin' => 'Quản trị viên',
        'accounts' => 'Tài khoản',

        'hr' => 'Ban nhân sự',
        'supervisor' => 'Trưởng khoa',
        'doctor' => 'Bác sĩ',
        'patient' => 'Bệnh nhân',
        'pharmacy' => 'Nhà thuốc',
        'hospital' => 'Bệnh viện',

        'avatar' => 'Ảnh đại diện',

        'username' => 'Tên',
        'name' => 'Họ tên',
        'hospital_name' => 'Tên bệnh viện',
        'email' => 'Email',
        'phone' => 'Số điện thoại',
        'country' => 'Quốc gia',
        'city' => 'Thành phố',
        'ward' => 'Phường',
        'address' => 'Địa chỉ',
        'website' => 'Trang web',
        'logo' => 'Logo',
        'description' => 'Mô tả',
        'contract_start_date' => 'Ngày bắt đầu hợp đồng',
        'contract_end_date' => 'Ngày kết thúc hợp đồng',
        'created_at' => 'Ngày tạo',
        'updated_at' => 'Ngày cập nhật',

        'status' => 'Trạng thái',
        'active' => 'Đang hoạt động',
        'locked' => 'Đã bị khóa',
        'waiting-approval' => 'Đang chờ phê duyệt',
        'suspended' => 'Đã đình chỉ',

        'view_image' => 'Xem hình ảnh',
        'approve' => 'Phê duyệt',
        'suspend' => 'Đình chỉ',
        'lock_account' => 'Khóa tài khoản',
        'restore' => 'Khôi phục',
        'reactivate' => 'Kích hoạt lại',
        'unlock_account' => 'Mở khóa tài khoản',
        'delete_permanently' => 'Xóa vĩnh viễn',

        'suspend_filter' => 'Người dùng bị đình chỉ',
        'suspend_filter_all' => 'Bao gồm cả người dùng bị đình chỉ',
        'suspend_filter_only' => 'Chỉ bao gồm người dùng bị đình chỉ',

        'suspend_modal_heading' => 'Đình chỉ tài khoản',
        'suspend_modal_description' => 'Bạn có chắc chắn muốn đình chỉ tài khoản này? Bệnh viện có thể thay đổi việc này.',
        'suspend_success' => 'Đã đình chỉ tài khoản thành công.',

        'lock_modal_heading' => 'Khóa tài khoản',
        'lock_modal_description' => 'Bạn có chắc chắn muốn khóa tài khoản này? Hành động chỉ có thể thay đổi bởi quản trị viên, bệnh viện sẽ không thể thay đổi!',
        'lock_success' => 'Đã khóa tài khoản thành công.',

        'restore_modal_heading' => 'Kích hoạt lại tài khoản',
        'restore_modal_description' => 'Bạn có chắc chắn muốn kích hoạt lại tài khoản này?',
        'restore_success' => 'Đã kích hoạt lại tài khoản thành công.',

        'delete_modal_heading' => 'Xóa tài khoản vĩnh viễn',
        'delete_modal_description' => 'Bạn có chắc chắn muốn xóa vĩnh viễn tài khoản này? Hành động này không thể hoàn tác.',
        'delete_success' => 'Đã xóa tài khoản thành công.',

        'view_account' => 'Tài khoản',
        'account_info' => 'Thông tin tài khoản',

        'activity' => 'Hoạt động',
        'action' => 'Hành động',
        'subject' => 'Đối tượng',
        'subject_id' => 'ID đối tượng',
        'subject_name' => 'Tên đối tượng',
        'causer' => 'Tác nhân',
        'causer_id' => 'ID tác nhân',
        'causer_name' => 'Tên tác nhân',
    ],

    'basic_info' => 'Thông tin cơ bản',
    'hospital_basic_info_description' => 'Cập nhật thông tin cơ bản của bệnh viện',
    'address_info_description' => 'Cập nhật thông tin địa chỉ của bệnh viện',
    'description_info' => 'Thông tin mô tả',
    'hospital_description_details' => 'Mô tả chi tiết về bệnh viện',
    'contact_info' => 'Thông tin liên hệ',
    'contact_info_description' => 'Thông tin về thời hạn hợp đồng',

    'success' => 'Thành công!',
    'notifation' => [
        'update_success' => 'Thông tin :name đã được cập nhật.',
    ],

    'event' => [
        'created' => 'Đã tạo',
        'updated' => 'Đã cập nhật',
        'deleted' => 'Đã xóa',
        'restored' => 'Đã khôi phục',
        'force_deleted' => 'Đã xóa vĩnh viễn',
    ],

    'mobile_app_url' => 'URL Ứng dụng di động',
    'app_url' => 'URL ứng dụng',
    'play_store_url' => 'URL cửa hàng Google Play',
    'app_store_url' => 'URL cửa hàng App Store',

    'system' => 'Hệ thống',
    'my_profile' => 'Hồ sơ của tôi',

    'close' => 'Đóng',
    'save' => 'Lưu',
    'cancel' => 'Hủy bỏ',
    'edit' => 'Chỉnh sửa',
    'delete' => 'Xóa',
    'create' => 'Tạo mới',
    'update' => 'Cập nhật',
];
