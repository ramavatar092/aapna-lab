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
        Schema::create('tests', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('dept_id');
            $table->string('table_type')->default('test');
            $table->string('title');
            $table->decimal('amount', 10, 2); // For price or cost with 2 decimal places
            $table->string('code')->unique(); // Ensure test_code is unique
            $table->string('gender')->nullable(); 
            $table->string('sample_type')->nullable();
            $table->string('age')->nullable();
            $table->string('suffix')->nullable();
         
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
