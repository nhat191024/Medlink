<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_insurances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_profile_id')->unique();
            $table->enum('insurance_type', ['public', 'private', 'vietnamese'])->nullable();
            $table->string('insurance_number')->nullable();

            $table->string('registry')->nullable(); //only for vietnamese insurance
            $table->string('registered_address')->nullable(); //only for vietnamese insurance
            $table->string('valid_from')->nullable(); //only for vietnamese insurance

            $table->string('main_insured')->nullable(); //only for private insurance
            $table->string('entitled_insured')->nullable(); //only for private insurance
            $table->string('assurance_type')->nullable();
            $table->timestamps();

            $table->foreign('patient_profile_id')->references('id')->on('patient_profiles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_insurances');
    }
};
