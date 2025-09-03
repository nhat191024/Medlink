# MEDLINK

<p align="center">
<img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
<img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
<img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
<img src="https://img.shields.io/badge/Status-Archived-red?style=for-the-badge" alt="Status">
</p>

## 🏥 Giới thiệu về dự án

**Medlink** là một hệ thống quản lý y tế toàn diện được phát triển như một phần của đồ án tốt nghiệp. Dự án nhằm mục đích cung cấp một nền tảng số hóa cho việc quản lý thông tin bệnh nhân, lịch hẹn khám, và các dịch vụ y tế.

### 📋 Thông tin dự án

-   **Tên dự án**: Medlink - Hệ thống Quản lý Y tế
-   **Loại**: Đồ án tốt nghiệp
-   **Công nghệ chính**: Laravel (PHP Framework)
-   **Database**: MySQL
-   **Tác giả**: nhat191024
-   **Trường**: FPT Polytechnic
-   **Khoa**: Web development
-   **Năm**: K18
-   **Giảng viên hướng dẫn**: Trần Nguyễn Khánh Lâm

### 🎯 Tính năng chính

-   👥 Quản lý thông tin bệnh nhân
-   📅 Hệ thống đặt lịch hẹn khám
-   👨‍⚕️ Quản lý thông tin bác sĩ và nhân viên y tế
-   💊 Quản lý thuốc và đơn thuốc
-   📊 Báo cáo và thống kê
-   🔐 Hệ thống xác thực và phân quyền
-   💳 Tích hợp thanh toán điện tử

### 🛠️ Công nghệ sử dụng

-   **Backend Framework**: Laravel 12
-   **Database**: MySQL
-   **Authentication**: Laravel Sanctum
-   **Admin Panel**: Filament
-   **Payment Integration**: PayOS
-   **File Storage**: Laravel Storage
-   **Queue Management**: Redis/Database
-   **Real-time**: Laravel Broadcasting

## ⚠️ Thông báo quan trọng

**🎓 DỰ ÁN ĐÃ NGỪNG CẬP NHẬT**

Dự án này đã được dừng cập nhập và nộp như một phần của đồ án tốt nghiệp. Kể từ ngày hoàn thành, dự án sẽ **không còn được cập nhật hoặc bảo trì thêm**.

### 📅 Timeline dự án

-   **Bắt đầu**: 26/05/2025
-   **Hoàn thành**: 03/09/2025
-   **Trạng thái**: ✅ Đã bảo vệ đồ án thành công. Dự án có thể còn tồn tại lỗi

## 🚀 Cài đặt và triển khai

### Yêu cầu hệ thống

-   PHP >= 8.2
-   Composer
-   MySQL >= 8.0
-   Node.js & NPM/PNPM (cho build assets)

### Cài đặt

```bash
# Clone repository
git clone [repository-url]
cd medlink-backend

# Cài đặt dependencies
composer install
pnpm install

# Cấu hình environment
cp .env.example .env
php artisan key:generate

# Migrate database
php artisan migrate --seed

# Build assets
pnpm run build

# Chạy server
php artisan serve
```

## 📚 Tài liệu API

API documentation có thể được truy cập tại `/api/documentation` khi chạy server local.

## 🔒 Bảo mật

Dự án này được phát triển với mục đích học tập và nghiên cứu. Không khuyến khích sử dụng trong môi trường production mà không có việc đánh giá bảo mật kỹ lưỡng.

## 📞 Liên hệ

Nếu có câu hỏi về dự án, vui lòng liên hệ:

-   Email: richberchannel01@gmail.com
-   GitHub: [nhat191024](https://github.com/nhat191024)

## 📄 License

Dự án này được phát hành dưới [MIT License](https://opensource.org/licenses/MIT).

---

**Lưu ý**: Đây là dự án học tập và nghiên cứu. Tác giả không chịu trách nhiệm cho việc sử dụng mã nguồn này trong các mục đích thương mại hoặc production.
