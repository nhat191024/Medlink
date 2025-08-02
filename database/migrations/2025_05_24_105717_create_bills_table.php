<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('appointment_id');
            $table->unsignedBigInteger('hospital_id');
            $table->enum('payment_method', ['wallet', 'credit_card', 'qr_transfer'])->default('wallet');
            $table->double('taxVAT')->default(0);
            $table->double('total')->default(0);
            $table->enum('status', ['pending', 'paid', 'cancelled', 'refunded'])->default('pending');
            $table->timestamps();

            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('restrict')->onUpdate('cascade');

            // Performance indexes
            $table->index(['status', 'created_at'], 'idx_bills_status_created');
            $table->index(['appointment_id', 'status'], 'idx_bills_appointment_status');
            $table->index(['hospital_id', 'status'], 'idx_bills_hospital_status');
            $table->index(['payment_method', 'status'], 'idx_bills_payment_status');
            $table->index(['total', 'status'], 'idx_bills_total_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
