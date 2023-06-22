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
        Schema::create('posts_tags', function (Blueprint $table) {
            $table->primary(['post_id', 'tag_id']);
            $table->foreignId('tag_id')->constrained('tags');
            $table->foreignId('post_id')->constrained('posts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts_tags');
    }
};
