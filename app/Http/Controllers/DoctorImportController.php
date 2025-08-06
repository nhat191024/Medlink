<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalCategory;

class DoctorImportController extends Controller
{
    public function downloadTemplate()
    {
        $templatePath = storage_path('app/templates/doctor_import_template.csv');

        // Nếu file chưa tồn tại, tạo mới
        if (!file_exists($templatePath)) {
            $this->generateTemplate();
        }

        // Download file
        return response()->download($templatePath, 'mau_import_bac_si.csv');
    }

    public function generateTemplate()
    {
        // Create directory if it doesn't exist
        $templateDir = storage_path('app/templates');
        if (!file_exists($templateDir)) {
            mkdir($templateDir, 0755, true);
        }

        // Create CSV content
        $csvData = [];

        // Headers (English - column names)
        $headers = [
            'name',
            'email',
            'password',
            'gender',
            'country_code',
            'phone',
            'address',
            'city',
            'ward',
            'country',
            'zip_code',
            'professional_number',
            'medical_category',
            'introduce',
            'office_address',
            'company_name'
        ];
        $csvData[] = $headers;

        // Vietnamese headers (for reference) - commented row
        $vietnameseHeaders = [
            '# Tên bác sĩ*',
            '# Email*',
            '# Mật khẩu*',
            '# Giới tính (male/female/other)',
            '# Mã quốc gia (+84)',
            '# Số điện thoại',
            '# Địa chỉ',
            '# Thành phố',
            '# Phường/Xã',
            '# Quốc gia',
            '# Mã bưu điện',
            '# Số chứng chỉ hành nghề*',
            '# Chuyên khoa',
            '# Giới thiệu',
            '# Địa chỉ phòng khám',
            '# Tên công ty'
        ];
        $csvData[] = $vietnameseHeaders;

        // Sample data
        $sampleData = [
            'Nguyễn Văn A',
            'doctor.example@email.com',
            '123456',
            'male',
            '+84',
            '0901234567',
            '123 Đường ABC',
            'Hồ Chí Minh',
            'Phường 1',
            'Việt Nam',
            '70000',
            'BS001234',
            'Tim mạch',
            'Bác sĩ có kinh nghiệm 10 năm trong lĩnh vực tim mạch',
            '456 Đường XYZ, Quận 1',
            'Bệnh viện ABC'
        ];
        $csvData[] = $sampleData;

        // Create CSV file
        $templatePath = storage_path('app/templates/doctor_import_template.csv');
        $file = fopen($templatePath, 'w');

        // Add BOM for UTF-8 to ensure proper encoding in Excel
        fwrite($file, "\xEF\xBB\xBF");

        foreach ($csvData as $row) {
            fputcsv($file, $row);
        }

        fclose($file);

        // Create instruction file
        $instructionPath = storage_path('app/templates/doctor_import_instructions.txt');
        $instructions = "HƯỚNG DẪN IMPORT BÁC SĨ

1. Các trường có dấu (*) là bắt buộc
2. Email phải là duy nhất trong hệ thống
3. Giới tính: male (nam), female (nữ), other (khác)
4. Mã quốc gia: ví dụ +84 cho Việt Nam
5. Dữ liệu mẫu ở dòng 3 có thể xóa sau khi tham khảo
6. Không thay đổi tên các cột ở dòng 1
7. Mật khẩu tối thiểu 6 ký tự
8. File phải được lưu dưới định dạng CSV (UTF-8)
9. Xóa dòng 2 (dòng có dấu #) trước khi import

DANH SÁCH CHUYÊN KHOA CÓ SẴN:
";

        try {
            $categories = MedicalCategory::all();
            foreach ($categories as $category) {
                $instructions .= "- " . $category->name . "\n";
            }
        } catch (\Exception $e) {
            $instructions .= "- Tim mạch\n- Nội khoa\n- Ngoại khoa\n- Sản phụ khoa\n- Nhi khoa\n";
        }

        file_put_contents($instructionPath, $instructions);
    }
}
