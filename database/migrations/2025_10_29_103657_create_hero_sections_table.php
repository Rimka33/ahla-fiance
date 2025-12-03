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
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('main_title');
            $table->text('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->json('typed_strings')->nullable()->comment('Array of strings for typed animation');
            $table->string('background_image')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_link')->nullable();
            $table->text('video_url')->nullable();
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
        Schema::dropIfExists('hero_sections');
    }
};
