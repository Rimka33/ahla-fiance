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
        Schema::table('pages', function (Blueprint $table) {
            $table->string('badge_text')->nullable()->after('title');
            $table->text('subtitle')->nullable()->after('badge_text');
            $table->string('image')->nullable()->after('content');

            // Champs pour page Contact
            $table->string('form_badge')->nullable();
            $table->string('form_title')->nullable();
            $table->text('form_description')->nullable();

            // Champs pour page À propos
            $table->longText('presentation_who')->nullable();
            $table->longText('presentation_mission')->nullable();
            $table->longText('presentation_vision')->nullable();
            $table->longText('why_content')->nullable();
            $table->longText('engagements_content')->nullable();

            // Champ pour page FAQ
            $table->string('ask_question_title')->nullable();
            $table->string('ask_question_subtitle')->nullable();
            $table->text('ask_question_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn([
                'badge_text',
                'subtitle',
                'image',
                'form_badge',
                'form_title',
                'form_description',
                'presentation_who',
                'presentation_mission',
                'presentation_vision',
                'why_content',
                'engagements_content',
                'ask_question_title',
                'ask_question_subtitle',
                'ask_question_description',
            ]);
        });
    }
};
