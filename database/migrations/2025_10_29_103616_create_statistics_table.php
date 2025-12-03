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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->integer('users_count')->default(0);
            $table->string('users_suffix')->default('M+');
            $table->integer('reviews_count')->default(0);
            $table->string('reviews_suffix')->default('+');
            $table->integer('countries_count')->default(0);
            $table->string('countries_suffix')->default('+');
            $table->integer('subscribers_count')->default(0);
            $table->string('subscribers_suffix')->default('M+');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
