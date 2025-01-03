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
        Schema::create('patient_billings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->dateTime('date');
            $table->string('discount_percent')->nullable();
            $table->string('discount_amount')->nullable();
            $table->string('discount_by')->nullable();
            $table->string('sampleCollector')->nullable();
            $table->string('organisation')->nullable();
            $table->string('collectedat')->nullable();
            $table->text('reason_of_discount')->nullable();
            $table->string('advanced_payment')->nullable();
            $table->string('due_payment')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('total_amount')->nullable(); 
            $table->string('paid_amount')->nullable();
            $table->string('status')->default('ongoing');
            $table->string('home_collection_charge')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_billings');
    }
};
