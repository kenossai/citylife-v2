<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn([
                'author_role',
                'author_bio',
                'author_avatar',
                'star_rating',
                'review_count',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('author_role', 150)->nullable();
            $table->text('author_bio')->nullable();
            $table->string('author_avatar', 300)->nullable();
            $table->decimal('star_rating', 3, 1)->default(0);
            $table->unsignedInteger('review_count')->default(0);
        });
    }
};
