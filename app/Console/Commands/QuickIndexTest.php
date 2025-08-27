<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class QuickIndexTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:quick-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Quick test to verify database indexes are working';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Quick Database Index Test');
        $this->info(str_repeat('=', 50));

        // Test 1: Check if indexes exist
        $this->testIndexesExist();

        // Test 2: Quick performance test
        $this->quickPerformanceTest();

        // Test 3: Show table status
        $this->showTableStatus();

        $this->info("\n✅ Quick test completed!");
    }

    private function testIndexesExist(): void
    {
        $this->info("\n📋 Checking Indexes...");

        $tables = ['users', 'appointments', 'bills', 'services', 'reviews'];

        foreach ($tables as $table) {
            try {
                $indexes = DB::select("SHOW INDEX FROM {$table}");
                $indexCount = count($indexes);

                if ($indexCount > 1) { // More than just PRIMARY
                    $this->line("  ✅ {$table}: {$indexCount} indexes");
                } else {
                    $this->line("  ❌ {$table}: Only primary key found");
                }
            } catch (\Exception $e) {
                $this->line("  ❌ {$table}: Table not found");
            }
        }
    }

    private function quickPerformanceTest(): void
    {
        $this->info("\n⚡ Quick Performance Test...");

        $tests = [
            'Users by type' => "SELECT COUNT(*) FROM users WHERE user_type = 'patient'",
            'Active services' => "SELECT COUNT(*) FROM services WHERE is_active = 1",
            'Recent appointments' => "SELECT COUNT(*) FROM appointments WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)",
        ];

        foreach ($tests as $testName => $query) {
            $start = microtime(true);
            try {
                DB::select($query);
                $time = (microtime(true) - $start) * 1000;
                $this->line("  ✅ {$testName}: " . number_format($time, 2) . "ms");
            } catch (\Exception $e) {
                $this->line("  ❌ {$testName}: Failed - " . $e->getMessage());
            }
        }
    }

    private function showTableStatus(): void
    {
        $this->info("\n📊 Table Statistics...");

        try {
            $stats = DB::select("
                SELECT
                    table_name,
                    table_rows,
                    ROUND((index_length / 1024 / 1024), 2) as index_size_mb
                FROM information_schema.TABLES
                WHERE table_schema = ?
                AND table_name IN ('users', 'appointments', 'bills', 'services', 'reviews')
                ORDER BY table_rows DESC
            ", [config('database.connections.mysql.database')]);

            if (!empty($stats)) {
                foreach ($stats as $stat) {
                    $this->line("  📊 {$stat->table_name}: {$stat->table_rows} rows, {$stat->index_size_mb}MB indexes");
                }
            } else {
                $this->line("  ℹ️  No statistics available");
            }
        } catch (\Exception $e) {
            $this->line("  ⚠️  Could not retrieve statistics: " . $e->getMessage());
        }
    }
}
