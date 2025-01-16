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
        Schema::create('patient_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_id'); 
            $table->string('title')->nullable();
            $table->foreignId('patient_id');
            $table->foreignId('test_id');
            $table->string('interpretation_status')->default(false);
            $table->string(column: 'test_parameter')->default('N/A')->nullable();
            $table->string(column: 'observed_value')->nullable();
            $table->string('unit')->nullable();
            $table->string('field')->nullable();
            $table->string('range_operation')->nullable();
            $table->string('range_value')->nullable();
            $table->decimal('range_min', 10, 2)->nullable();
            $table->decimal('range_max', 10, 2)->nullable();
            $table->string('multiple_range')->nullable();
            $table->string('custom_default')->nullable();
            $table->string('custom_option')->nullable();
            $table->string('custom_range')->nullable();
            $table->text('range_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_reports');
    }
};
