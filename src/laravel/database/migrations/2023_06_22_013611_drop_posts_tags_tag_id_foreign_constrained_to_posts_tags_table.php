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
        Schema::table('posts_tags', function (Blueprint $table) {
            $table->dropForeign('posts_tags_tag_id_foreign');
            $table->dropForeign('posts_tags_post_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts_tags', function (Blueprint $table) {
            //
        });
    }
};
