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
        Schema::create('organisations', function (Blueprint $table) {
            $table->id();
            $table->string('ref_type')->comment('Reference type: Doctor or Hospital');
            $table->string('name')->comment('Name of the organisation');
            $table->string('degree')->nullable()->comment('Email address');
            $table->decimal('compliment', 5, 2)->nullable()->comment('Compliment percentage');
            $table->string('address')->nullable();
            $table->boolean('financial_analysis')->nullable()->default(0);
            $table->boolean('clear_due')->nullable()->default(0);
            $table->boolean('login_status')->default(0)->comment('Login status: 0 for inactive, 1 for active');
            $table->foreignId('test_id')->nullable()->constrained()->onDelete('cascade')->comment('Reference to test');
            $table->string('created_by')->nullable()->comment('User who created this record');
            $table->string('updated_by')->nullable()->comment('User who last updated this record');
            $table->string('deleted_by')->nullable()->comment('User who deleted this record');
            $table->softDeletes(); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisations');
    }
};
