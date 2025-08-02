<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_profile_id');
            $table->unsignedBigInteger('patient_profile_id');
            $table->unsignedBigInteger('appointment_id');
            $table->text('review');
            $table->float('rate');
            $table->boolean('recommend');
            $table->timestamps();

            $table->foreign('doctor_profile_id')->references('id')->on('doctor_profiles')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('patient_profile_id')->references('id')->on('patient_profiles')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('restrict')->onUpdate('cascade');

            // Performance indexes
            $table->index(['doctor_profile_id', 'created_at'], 'idx_reviews_doctor_created');
            $table->index(['patient_profile_id', 'created_at'], 'idx_reviews_patient_created');
            $table->index(['rate', 'created_at'], 'idx_reviews_rating_created');
            $table->unique(['appointment_id'], 'uk_reviews_appointment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
