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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('header_image')->nullable(); // Stores path to the header image
            $table->integer('header_height')->default(100); // Height of the header
            $table->string('footer_image')->nullable(); // Stores path to the footer image
            $table->integer('footer_height')->default(60); // Height of the footer
            $table->string('background_image')->nullable(); // Stores path to the background image
            $table->string('font')->default('Roboto'); // Font selection
            $table->integer('left_margin')->default(25); // Left margin
            $table->integer('right_margin')->default(25); // Right margin
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
