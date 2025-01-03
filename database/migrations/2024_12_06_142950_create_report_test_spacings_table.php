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
        Schema::create('report_test_spacings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->float('departmentFontSize')->nullable();
            $table->float('columnHeadingFontSize')->nullable();
            $table->float('testNameFontSize')->nullable();
            $table->float('sampleTypeFontSize')->nullable();
            $table->float('testParameterFontSize')->nullable();
            $table->float('testMethodFontSize')->nullable();
            $table->float('spacingBetweenTests')->nullable();
            $table->boolean('barcode')->default(false);
            $table->float('spacingDepartment')->nullable();
            $table->float('spacingTestName')->nullable();
            $table->float('spacingColumnHeader')->nullable();
            $table->float('spacingTestParameters')->nullable();
            $table->float('spacingTestMethod')->nullable();
            $table->string('refRange')->nullable();
            $table->string('spacingUnit')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_test_spacings');
    }
};
