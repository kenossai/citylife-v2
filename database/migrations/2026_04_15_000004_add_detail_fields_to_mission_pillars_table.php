<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mission_pillars', function (Blueprint $table) {
            $table->string('slug', 120)->unique()->nullable()->after('title');
            $table->string('subtitle', 150)->nullable()->after('slug');
            $table->text('about_text')->nullable()->after('description');
            $table->string('vision_quote', 400)->nullable()->after('about_text');
            $table->json('gallery_images')->nullable()->after('image_path');
        });
    }

    public function down(): void
    {
        Schema::table('mission_pillars', function (Blueprint $table) {
            $table->dropColumn(['slug', 'subtitle', 'about_text', 'vision_quote', 'gallery_images']);
        });
    }
};
