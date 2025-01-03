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
        Schema::create('bill_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('bill_size');
            $table->string('bill_heading')->nullable();
            $table->string('name')->nullable();
            $table->string('gst')->nullable();
            $table->string('bill_header')->nullable();
            $table->string('bill_footer')->nullable();
            $table->string('sign')->nullable();
            $table->boolean('show_gst')->nullable();
            $table->integer('header_height')->nullable();
            $table->integer('footer_height')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_details');
    }
};
