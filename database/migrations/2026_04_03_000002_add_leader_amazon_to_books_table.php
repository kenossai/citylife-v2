<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->foreignId('leader_id')->nullable()->constrained('leaders')->nullOnDelete()->after('id');
            $table->string('amazon_url', 300)->nullable()->after('kindle_url');
            $table->dropColumn(['price', 'ebook_price', 'read_time_hours', 'preview_url']);
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['leader_id']);
            $table->dropColumn(['leader_id', 'amazon_url']);
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('ebook_price', 8, 2)->nullable();
            $table->unsignedTinyInteger('read_time_hours')->nullable();
            $table->string('preview_url', 300)->nullable();
        });
    }
};
