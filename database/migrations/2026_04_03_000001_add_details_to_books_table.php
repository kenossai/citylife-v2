<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('subtitle', 255)->nullable()->after('author');
            $table->unsignedSmallInteger('page_count')->nullable()->after('subtitle');
            $table->unsignedTinyInteger('read_time_hours')->nullable()->after('page_count');
            $table->string('publisher', 150)->nullable()->after('read_time_hours');
            $table->string('published_month', 20)->nullable()->after('publisher');
            $table->decimal('price', 8, 2)->nullable()->after('published_month');
            $table->decimal('ebook_price', 8, 2)->nullable()->after('price');
            $table->string('kindle_url', 300)->nullable()->after('ebook_price');
            $table->string('preview_url', 300)->nullable()->after('kindle_url');
            $table->string('isbn', 30)->nullable()->after('preview_url');
            $table->string('language', 50)->default('English')->after('isbn');
            $table->string('format', 100)->nullable()->after('language');
            $table->string('author_role', 150)->nullable()->after('format');
            $table->text('author_bio')->nullable()->after('author_role');
            $table->string('author_avatar', 300)->nullable()->after('author_bio');
            $table->json('categories')->nullable()->after('author_avatar');
            $table->decimal('star_rating', 3, 1)->default(0)->after('categories');
            $table->unsignedInteger('review_count')->default(0)->after('star_rating');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn([
                'subtitle', 'page_count', 'read_time_hours', 'publisher', 'published_month',
                'price', 'ebook_price', 'kindle_url', 'preview_url', 'isbn', 'language', 'format',
                'author_role', 'author_bio', 'author_avatar', 'categories',
                'star_rating', 'review_count',
            ]);
        });
    }
};
