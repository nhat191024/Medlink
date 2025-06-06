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

            $table->string('email')->unique();
            $table->string('password');

            $table->string('avatar')->nullable();
            $table->string('name')->nullable();
            $table->string('country_code')->nullable();
            $table->string('phone')->nullable();

            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('address')->nullable();
            $table->string('zip_code')->nullable();

            $table->enum('status', ['suspend', 'waiting-approval', 'active'])->default('active');
            $table->softDeletes();
            $table->timestamp('last_login')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
