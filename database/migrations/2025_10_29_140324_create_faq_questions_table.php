<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration renommée pour s'exécuter après contact_messages
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('faq_questions')) {
            return;
        }

        Schema::create('faq_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->string('category')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_published')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->string('client_email')->nullable(); // Si provenant d'un message contact
            $table->text('admin_notes')->nullable();
            $table->enum('status', ['pending', 'answered', 'published', 'archived'])->default('pending');
            $table->timestamp('answered_at')->nullable();
            $table->foreignId('contact_message_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq_questions');
    }
};
