<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabasePerformanceTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:performance-test {--before-indexes : Run test before indexes are applied}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test database performance before and after adding indexes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Starting Database Performance Test...');
        $isBeforeIndexes = $this->option('before-indexes');

        $testResults = [];

        // Test 1: Find active doctors
        $testResults['active_doctors'] = $this->testQuery(
            'Active Doctors Query',
            "SELECT u.*, dp.* FROM users u
             JOIN doctor_profiles dp ON u.id = dp.user_id
             WHERE u.user_type = 'healthcare' AND u.status = 'active'
             LIMIT 10"
        );

        // Test 2: Upcoming appointments for specific doctor
        $testResults['doctor_appointments'] = $this->testQuery(
            'Doctor Appointments Query',
            "SELECT a.*, pp.*, u.name as patient_name
             FROM appointments a
             JOIN patient_profiles pp ON a.patient_profile_id = pp.id
             JOIN users u ON pp.user_id = u.id
             WHERE a.doctor_profile_id = 1
             AND a.date >= CURDATE()
             AND a.status = 'upcoming'
             ORDER BY a.date, a.time
             LIMIT 20"
        );

        // Test 3: Bills by status and date range
        $testResults['bills_report'] = $this->testQuery(
            'Bills Report Query',
            "SELECT
                status,
                payment_method,
                COUNT(*) as count,
                SUM(total) as total_amount,
                AVG(total) as avg_amount
             FROM bills
             WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
             GROUP BY status, payment_method
             ORDER BY total_amount DESC"
        );

        // Test 4: Doctor reviews with ratings
        $testResults['doctor_reviews'] = $this->testQuery(
            'Doctor Reviews Query',
            "SELECT
                dp.id as doctor_id,
                u.name as doctor_name,
                COUNT(r.id) as review_count,
                AVG(r.rate) as avg_rating
             FROM doctor_profiles dp
             JOIN users u ON dp.user_id = u.id
             LEFT JOIN reviews r ON dp.id = r.doctor_profile_id
             WHERE r.created_at >= DATE_SUB(NOW(), INTERVAL 90 DAY)
             GROUP BY dp.id, u.name
             HAVING review_count > 0
             ORDER BY avg_rating DESC, review_count DESC
             LIMIT 15"
        );

        // Test 5: Services by doctor and price range
        $testResults['services_search'] = $this->testQuery(
            'Services Search Query',
            "SELECT s.*, dp.*, u.name as doctor_name, h.name as hospital_name
             FROM services s
             JOIN doctor_profiles dp ON s.doctor_profile_id = dp.id
             JOIN users u ON dp.user_id = u.id
             JOIN hospitals h ON dp.hospital_id = h.id
             WHERE s.is_active = 1
             AND s.price BETWEEN 100000 AND 500000
             ORDER BY s.price ASC
             LIMIT 25"
        );

        // Test 6: User notifications
        $testResults['user_notifications'] = $this->testQuery(
            'User Notifications Query',
            "SELECT * FROM user_notifications
             WHERE user_id IN (1,2,3,4,5)
             AND status = 'unread'
             ORDER BY created_at DESC
             LIMIT 50"
        );

        // Test 7: Appointment statistics
        $testResults['appointment_stats'] = $this->testQuery(
            'Appointment Statistics Query',
            "SELECT
                DATE(date) as appointment_date,
                status,
                COUNT(*) as count
             FROM appointments
             WHERE date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
             GROUP BY DATE(date), status
             ORDER BY appointment_date DESC, count DESC"
        );

        // Display results
        $this->displayResults($testResults, $isBeforeIndexes);

        if ($isBeforeIndexes) {
            $this->warn('💡 Run "php artisan migrate" to add indexes, then run this command again without --before-indexes flag to see the improvement!');
        } else {
            $this->info('✅ Performance test completed with indexes applied!');
        }
    }

    private function testQuery(string $testName, string $query): array
    {
        $this->line("Testing: {$testName}");

        // Warm up
        DB::select($query);

        // Measure performance
        $times = [];
        for ($i = 0; $i < 5; $i++) {
            $start = microtime(true);
            $results = DB::select($query);
            $end = microtime(true);
            $times[] = ($end - $start) * 1000; // Convert to milliseconds
        }

        $avgTime = array_sum($times) / count($times);
        $resultCount = count($results ?? []);

        $this->line("  Average time: " . number_format($avgTime, 2) . "ms");
        $this->line("  Results: {$resultCount} rows");

        return [
            'test_name' => $testName,
            'avg_time_ms' => $avgTime,
            'result_count' => $resultCount,
            'query' => $query
        ];
    }

    private function displayResults(array $results, bool $isBeforeIndexes): void
    {
        $status = $isBeforeIndexes ? '📊 BEFORE INDEXES' : '🚀 AFTER INDEXES';

        $this->info("\n" . str_repeat('=', 60));
        $this->info($status);
        $this->info(str_repeat('=', 60));

        $totalTime = 0;
        $table = [];

        foreach ($results as $result) {
            $totalTime += $result['avg_time_ms'];
            $table[] = [
                $result['test_name'],
                number_format($result['avg_time_ms'], 2) . 'ms',
                $result['result_count'] . ' rows'
            ];
        }

        $this->table(['Test Name', 'Avg Time', 'Results'], $table);

        $this->info("\n📈 SUMMARY:");
        $this->info("Total Average Time: " . number_format($totalTime, 2) . "ms");
        $this->info("Tests Run: " . count($results));
        $this->info("Timestamp: " . Carbon::now()->format('Y-m-d H:i:s'));

        // Save results to file for comparison
        $filename = $isBeforeIndexes ? 'performance_before_indexes.json' : 'performance_after_indexes.json';
        $filepath = storage_path('logs/' . $filename);

        file_put_contents($filepath, json_encode([
            'timestamp' => Carbon::now()->toISOString(),
            'is_before_indexes' => $isBeforeIndexes,
            'total_time_ms' => $totalTime,
            'results' => $results
        ], JSON_PRETTY_PRINT));

        $this->info("Results saved to: {$filepath}");

        // If both files exist, show comparison
        if (!$isBeforeIndexes && file_exists(storage_path('logs/performance_before_indexes.json'))) {
            $this->showComparison();
        }
    }

    private function showComparison(): void
    {
        $beforeFile = storage_path('logs/performance_before_indexes.json');
        $afterFile = storage_path('logs/performance_after_indexes.json');

        if (!file_exists($beforeFile) || !file_exists($afterFile)) {
            return;
        }

        $before = json_decode(file_get_contents($beforeFile), true);
        $after = json_decode(file_get_contents($afterFile), true);

        $this->info("\n" . str_repeat('=', 60));
        $this->info('📊 PERFORMANCE COMPARISON');
        $this->info(str_repeat('=', 60));

        $totalBefore = $before['total_time_ms'];
        $totalAfter = $after['total_time_ms'];
        $improvement = (($totalBefore - $totalAfter) / $totalBefore) * 100;

        $comparisonTable = [];

        foreach ($before['results'] as $index => $beforeResult) {
            $afterResult = $after['results'][$index] ?? null;

            if ($afterResult) {
                $timeBefore = $beforeResult['avg_time_ms'];
                $timeAfter = $afterResult['avg_time_ms'];
                $testImprovement = (($timeBefore - $timeAfter) / $timeBefore) * 100;

                $comparisonTable[] = [
                    $beforeResult['test_name'],
                    number_format($timeBefore, 2) . 'ms',
                    number_format($timeAfter, 2) . 'ms',
                    ($testImprovement > 0 ? '+' : '') . number_format($testImprovement, 1) . '%'
                ];
            }
        }

        $this->table(['Test Name', 'Before', 'After', 'Improvement'], $comparisonTable);

        $this->info("\n🎉 OVERALL IMPROVEMENT:");
        $this->info("Before Indexes: " . number_format($totalBefore, 2) . "ms");
        $this->info("After Indexes: " . number_format($totalAfter, 2) . "ms");

        if ($improvement > 0) {
            $this->info("Performance Improvement: +" . number_format($improvement, 1) . "%");
            $this->info("Time Saved: " . number_format($totalBefore - $totalAfter, 2) . "ms");
        } else {
            $this->warn("Performance Degradation: " . number_format($improvement, 1) . "%");
        }
    }
}
