<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('email', 500)->nullable();
            $table->string('address', 5000)->nullable();
            $table->string('phone', 100)->nullable();

            $table->enum('doctor_approved', ['0', '1'])->default('1')->comment('1=>approve,0=>not need to approve');

            $table->string('app_url', 250)->nullable();
            $table->string('play_store_url', 250)->nullable();

            $table->string('main_banner', 250)->nullable();
            $table->string('favicon', 250)->nullable();
            $table->string('logo', 250)->nullable();

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
        Schema::dropIfExists('settings');
    }
}
