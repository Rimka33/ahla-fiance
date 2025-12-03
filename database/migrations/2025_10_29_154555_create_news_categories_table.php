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
        Schema::create('news_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('color')->nullable(); // Pour l'affichage avec badge coloré
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Ajouter la colonne category_id dans la table news
        Schema::table('news', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('id')->constrained('news_categories')->onDelete('set null');
        });

        // Ajouter champ published_at si pas déjà présent
        if (!Schema::hasColumn('news', 'published_at')) {
            Schema::table('news', function (Blueprint $table) {
                $table->timestamp('published_at')->nullable()->after('is_published');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_categories');
    }
};
