<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_profile_id');
            $table->unsignedBigInteger('doctor_profile_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('hospital_id');
            //cancelled - appointment was cancelled by patient or doctor
            //rejected - appointment was rejected by doctor
            //pending - appointment is waiting for confirmation
            //upcoming - appointment is confirmed and upcoming
            //waiting - appointment is in progress and waiting for doctor to confirm completion
            //completed - appointment has been completed
            $table->enum('status', ['cancelled', 'rejected', 'pending', 'upcoming', 'waiting', 'completed'])->default('pending');
            $table->text('medical_problem');
            $table->string('medical_problem_file')->nullable();
            $table->integer('duration');
            $table->date('date');
            $table->string('day_of_week');
            $table->string('time');
            $table->string('reason')->nullable();
            $table->string('link')->nullable();
            $table->string('address')->nullable();
            $table->boolean('status_job_scheduled')->default(false);
            $table->timestamp('status_job_scheduled_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('patient_profile_id')->references('id')->on('patient_profiles')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('doctor_profile_id')->references('id')->on('doctor_profiles')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('restrict')->onUpdate('cascade');

            // Performance indexes
            $table->index(['doctor_profile_id', 'date', 'status'], 'idx_appointments_doctor_date_status');
            $table->index(['patient_profile_id', 'date', 'status'], 'idx_appointments_patient_date_status');
            $table->index(['date', 'status'], 'idx_appointments_date_status');
            $table->index(['status', 'created_at'], 'idx_appointments_status_created');
            $table->index(['service_id', 'status'], 'idx_appointments_service_status');
            $table->index(['day_of_week', 'time'], 'idx_appointments_schedule');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
