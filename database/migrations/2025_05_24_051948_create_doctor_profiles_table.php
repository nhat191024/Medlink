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
        Schema::create('doctor_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('hospital_id');
            $table->string('id_card_path')->nullable();
            $table->string('medical_degree_path')->nullable();
            $table->string('professional_card_path')->nullable();
            $table->string('exploitation_license_path')->nullable();
            $table->string('professional_number')->nullable();
            $table->text('introduce')->nullable();
            $table->unsignedBigInteger('medical_category_id')->nullable();
            $table->string('office_address')->nullable();
            $table->string('company_name')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('medical_category_id')->references('id')->on('medical_categories')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_profiles');
    }
};
