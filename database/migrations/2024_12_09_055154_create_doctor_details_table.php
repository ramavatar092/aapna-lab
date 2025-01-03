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
        Schema::create('doctor_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('doctor_name');
            $table->string('degree');
            $table->string('sign')->nullable();
            $table->enum('position', ['left', 'middle', 'right']);
            $table->integer('doctor_name_font');
            $table->integer('degree_font_size');
            $table->integer('spacing');
            $table->integer('space_name_degree');
            $table->enum('alignment', ['left', 'center', 'right']);
            $table->enum('signature_setting', ['fixed', 'select']);
            $table->boolean('end_of_report')->default(false);
            $table->string('department')->nullable();
            $table->string('user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_details');
    }
};
