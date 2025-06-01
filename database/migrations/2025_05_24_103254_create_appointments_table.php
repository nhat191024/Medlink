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
            $table->enum('status', ['cancelled', 'rejected', 'pending', 'upcoming', 'Completed'])->default('pending');
            $table->text('medical_problem');
            $table->string('medical_problem_file')->nullable();
            $table->integer('duration');
            $table->date('date');
            $table->string('day_of_week');
            $table->string('time');
            $table->string('reason')->nullable();
            $table->string('link')->nullable();
            $table->string('address')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('patient_profile_id')->references('id')->on('patient_profiles')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('doctor_profile_id')->references('id')->on('doctor_profiles')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('restrict')->onUpdate('cascade');
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
