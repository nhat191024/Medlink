<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->enum('user_type', ['healthcare', 'patient', 'admin'])->default('patient');
            $table->enum('identity', ['none', 'doctor', 'pharmacies', 'hospital', 'ambulance'])->default('none');

            $table->unsignedBigInteger('hospital_id')->nullable();

            $table->string('email')->unique();
            $table->string('password');

            $table->string('avatar')->nullable();
            $table->string('name')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('country_code')->nullable();
            $table->string('phone')->nullable();

            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('ward')->nullable();
            $table->string('address')->nullable();
            $table->string('zip_code')->nullable();

            $table->enum('status', ['suspend', 'waiting-approval', 'active'])->default('active');
            $table->softDeletes();
            $table->timestamp('last_login')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('restrict')->onUpdate('cascade');

            // Performance indexes
            $table->index(['user_type', 'status'], 'idx_users_type_status');
            $table->index('hospital_id', 'idx_users_hospital_id');
            $table->index(['status', 'created_at'], 'idx_users_status_created');
            $table->index(['email', 'status'], 'idx_users_email_status');
            $table->index(['phone'], 'idx_users_phone');
            $table->index(['city', 'status'], 'idx_users_city_status');
            $table->index(['last_login'], 'idx_users_last_login');
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
    }
}
