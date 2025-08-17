<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\DoctorProfile;
use App\Models\Hospital;
use App\Models\MedicalCategory;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

use App\Notifications\DoctorImportCompleted;
use App\Notifications\DoctorImportFailed;

use PhpOffice\PhpSpreadsheet\IOFactory;

use Throwable;

class ImportDoctorsJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public $timeout = 300; // 5 minutes
    public $tries = 3;

    protected $filePath;
    protected $userId;

    /**
     * Create a new job instance.
     */
    public function __construct(string $filePath, int $userId)
    {
        $this->filePath = $filePath;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $importedCount = 0;
        $errorCount = 0;
        $errors = [];

        try {
            DB::beginTransaction();

            $spreadsheet = IOFactory::load($this->filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            // Bỏ qua hàng đầu tiên (header) và hàng thứ 2
            $header = array_shift($rows);
            $secondRow = array_shift($rows);

            foreach ($rows as $index => $row) {
                try {
                    $rowNumber = $index + 3; // +3 vì đã bỏ header và row thứ 2, và index bắt đầu từ 0

                    // Kiểm tra dữ liệu đầu vào
                    if (count($row) < 6) {
                        $errors[] = "Row {$rowNumber}: Không đủ dữ liệu (cần ít nhất 6 cột)";
                        $errorCount++;
                        continue;
                    }

                    // Lấy dữ liệu từ Excel
                    $doctorName = trim($row[0] ?? '');
                    $doctorEmail = trim($row[1] ?? '');
                    $doctorGender = trim($row[2] ?? '');
                    $doctorCountryCode = trim($row[3] ?? '');
                    $doctorPhone = trim($row[4] ?? '');
                    $doctorAddress = trim($row[5] ?? '');
                    $doctorCity = trim($row[6] ?? '');
                    $doctorWard = trim($row[7] ?? '');
                    $doctorCountry = trim($row[8] ?? '');
                    $doctorZipCode = trim($row[9] ?? '');

                    $professionalNumber = trim($row[10] ?? '');
                    $medicalCategoryName = trim($row[11] ?? '');
                    $introduce = trim($row[12] ?? '');
                    $officeAddress = trim($row[13] ?? '');
                    $companyName = trim($row[14] ?? '');

                    // Validate dữ liệu
                    if (empty($doctorName) || empty($doctorEmail) || empty($medicalCategoryName)) {
                        $errors[] = "Row {$rowNumber}: Thiếu thông tin bắt buộc (tên, email, hoặc chuyên khoa)";
                        $errorCount++;
                        continue;
                    }

                    // Validate email format
                    if (!filter_var($doctorEmail, FILTER_VALIDATE_EMAIL)) {
                        $errors[] = "Row {$rowNumber}: Email không hợp lệ: {$doctorEmail}";
                        $errorCount++;
                        continue;
                    }

                    // Kiểm tra email đã tồn tại
                    if (User::where('email', $doctorEmail)->exists()) {
                        $errors[] = "Row {$rowNumber}: Email đã tồn tại: {$doctorEmail}";
                        $errorCount++;
                        continue;
                    }

                    // Tìm hoặc tạo medical category
                    $medicalCategory = MedicalCategory::firstOrCreate(
                        ['name' => $medicalCategoryName],
                        ['name' => $medicalCategoryName]
                    );

                    // Tạo user doctor
                    $user = User::create([
                        'user_type' => 'healthcare',
                        'identity' => 'doctor',

                        'hospital_id' => $this->userId,

                        'email' => $doctorEmail,
                        'password' => Hash::make('Password1$'),

                        'name' => $doctorName,
                        'gender' => $doctorGender,
                        'country_code' => $doctorCountryCode,
                        'phone' => $doctorPhone,

                        'country' => $doctorCountry,
                        'city' => $doctorCity,
                        'ward' => $doctorWard,
                        'address' => $doctorAddress,
                        'zip_code' => $doctorZipCode,

                        'status' => 'active',
                    ]);

                    // Tạo doctor profile
                    DoctorProfile::create([
                        'user_id' => $user->id,
                        'professional_number' => $professionalNumber,
                        'introduce' => $introduce,
                        'medical_category_id' => $medicalCategory->id,
                        'office_address' => $officeAddress,
                        'company_name' => $companyName,
                    ]);

                    $importedCount++;
                } catch (Throwable $e) {
                    $errors[] = "Row {$rowNumber}: Lỗi khi xử lý - " . $e->getMessage();
                    $errorCount++;
                    Log::error("Import doctor error at row {$rowNumber}: " . $e->getMessage());
                }
            }

            DB::commit();

            // Gửi thông báo thành công
            $user = Hospital::find($this->userId, 'id');
            if ($user) {
                $user->notify(new DoctorImportCompleted($importedCount, $errorCount, $errors));
            }

            Log::info("Doctor import completed: {$importedCount} imported, {$errorCount} errors");
        } catch (Throwable $e) {
            DB::rollBack();

            // Gửi thông báo lỗi
            $user = Hospital::find($this->userId, 'id');
            if ($user) {
                $user->notify(new DoctorImportFailed($e->getMessage()));
            }

            Log::error("Doctor import failed: " . $e->getMessage());

            throw $e;
        } finally {
            // Xóa file tạm
            if (file_exists($this->filePath)) {
                unlink($this->filePath);
            }
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(Throwable $exception): void
    {
        Log::error("ImportDoctorsJob failed: " . $exception->getMessage());

        $user = Hospital::find($this->userId, 'id');
        if ($user) {
            $user->notify(new DoctorImportFailed($exception->getMessage()));
        }

        // Xóa file tạm nếu job fail
        if (file_exists($this->filePath)) {
            unlink($this->filePath);
        }
    }
}
