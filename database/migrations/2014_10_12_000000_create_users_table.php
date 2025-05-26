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

            $table->string('email')->unique();
            $table->string('password');

            $table->string('avatar')->nullable();
            $table->string('full_name')->nullable();
            $table->string('country_code')->nullable();
            $table->string('phone')->nullable();

            $table->double('wallet')->default(0);

            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('address')->nullable();
            $table->string('zip_code')->nullable();

            $table->enum('status', [0, 1, 2])->default(2); //0: suspend, 1: waiting approval, 2: active
            $table->timestamp('last_login')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
    }
}
