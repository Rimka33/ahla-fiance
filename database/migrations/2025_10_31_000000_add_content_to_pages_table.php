<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            if (!Schema::hasColumn('pages', 'content')) {
                $table->text('content')->nullable()->after('subtitle');
            }
        });
    }

    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            if (Schema::hasColumn('pages', 'content')) {
                $table->dropColumn('content');
            }
        });
    }
};
