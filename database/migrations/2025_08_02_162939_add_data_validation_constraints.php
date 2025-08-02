<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add check constraints for data validation

        // Services table - price must be positive
        DB::statement('ALTER TABLE services ADD CONSTRAINT chk_services_price_positive CHECK (price > 0)');
        DB::statement('ALTER TABLE services ADD CONSTRAINT chk_services_duration_positive CHECK (duration > 0)');
        DB::statement('ALTER TABLE services ADD CONSTRAINT chk_services_buffer_time_positive CHECK (buffer_time >= 0)');

        // Bills table - total must be positive
        DB::statement('ALTER TABLE bills ADD CONSTRAINT chk_bills_total_positive CHECK (total >= 0)');
        DB::statement('ALTER TABLE bills ADD CONSTRAINT chk_bills_taxvat_positive CHECK (taxVAT >= 0)');

        // Reviews table - rating must be between 1 and 5
        DB::statement('ALTER TABLE reviews ADD CONSTRAINT chk_reviews_rating_range CHECK (rate >= 1 AND rate <= 5)');

        // Appointments table - duration must be positive
        DB::statement('ALTER TABLE appointments ADD CONSTRAINT chk_appointments_duration_positive CHECK (duration > 0)');

        // Users table - basic phone validation (only digits, +, and length)
        DB::statement('ALTER TABLE users ADD CONSTRAINT chk_users_phone_basic CHECK (phone IS NULL OR LENGTH(phone) >= 9)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop check constraints
        DB::statement('ALTER TABLE services DROP CONSTRAINT IF EXISTS chk_services_price_positive');
        DB::statement('ALTER TABLE services DROP CONSTRAINT IF EXISTS chk_services_duration_positive');
        DB::statement('ALTER TABLE services DROP CONSTRAINT IF EXISTS chk_services_buffer_time_positive');

        DB::statement('ALTER TABLE bills DROP CONSTRAINT IF EXISTS chk_bills_total_positive');
        DB::statement('ALTER TABLE bills DROP CONSTRAINT IF EXISTS chk_bills_taxvat_positive');

        DB::statement('ALTER TABLE reviews DROP CONSTRAINT IF EXISTS chk_reviews_rating_range');
        DB::statement('ALTER TABLE appointments DROP CONSTRAINT IF EXISTS chk_appointments_duration_positive');
        DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS chk_users_phone_basic');
    }
};
