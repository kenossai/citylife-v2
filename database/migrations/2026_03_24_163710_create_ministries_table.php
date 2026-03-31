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
        Schema::create('ministries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable();              // e.g. "Ages 13 – 25"
            $table->text('description');
            $table->text('about_text')->nullable();               // full detail page "Who We Are" text
            $table->text('vision_quote')->nullable();             // highlighted quote block
            $table->string('image_path')->nullable();             // card / hero background image
            $table->json('gallery_images')->nullable();           // array of image URLs
            $table->string('category_label')->nullable();         // e.g. "Youth", "Kids"
            $table->string('meeting_schedule')->nullable();       // e.g. "Fridays · 7:00 PM"
            $table->string('location')->nullable();               // e.g. "Main Auditorium"
            $table->string('leader_name')->nullable();            // e.g. "Ps. Daniel Wright"
            $table->string('leader_role')->nullable();            // e.g. "Ministry Lead"
            $table->string('leader_image')->nullable();           // leader photo URL
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ministries');
    }
};
