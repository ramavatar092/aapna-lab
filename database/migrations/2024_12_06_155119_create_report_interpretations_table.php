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
        Schema::create('report_interpretations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->integer('interpretation_heading_font_size')->default(12);
            $table->integer('interpretation_content_font_size')->default(12);
            $table->integer('note_heading_font_size')->default(12);
            $table->integer('note_content_font_size')->default(12);
            $table->string('logo')->nullable();
            $table->integer('logo_size')->default(100);
            $table->integer('logo_margin')->default(0);
            $table->integer('top_margin')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_interpretations');
    }
};
