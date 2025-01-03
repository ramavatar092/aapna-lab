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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('designation'); // For Designation
            $table->string('name'); // For Name
            $table->string('ph_number'); // For Phone Number
            $table->string('email')->nullable(); // For Email
            $table->decimal('discount_percentage', 5, 2)->default(0); // Discount percentage (with precision)
            $table->decimal('discount_rupee', 10, 2)->default(0); // Discount in rupees
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
