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
        Schema::create('test_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id');   
            $table->foreignId('parent_id')->nullable();
            $table->string('test_name')->nullable();
            $table->string('test_method')->nullable();
            $table->string('field')->nullable();
            $table->string('unit')->nullable();
            $table->decimal('range_min', 10, 2)->nullable();
            $table->decimal('range_max', 10, 2)->nullable();
            $table->string('range_operation')->nullable();
            $table->string('range_value')->nullable();
            $table->string('multiple_range')->nullable();
            $table->string('custom_default')->nullable();
            $table->string('custom_option')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_features');
    }
};
