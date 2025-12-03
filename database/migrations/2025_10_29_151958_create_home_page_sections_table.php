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
        Schema::create('home_page_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique(); // 'about', 'used_app_text', etc.
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('badge_text')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();
            $table->string('image')->nullable();
            $table->string('video_thumbnail')->nullable();
            $table->string('video_url')->nullable();
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_page_sections');
    }
};
