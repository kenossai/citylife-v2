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
        Schema::create('bible_school_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('speaker_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug');
            $table->string('type')->default('video'); // video | audio
            $table->smallInteger('year');
            $table->string('duration', 20)->nullable();
            $table->string('youtube_id', 50)->nullable();
            $table->string('audio_file')->nullable();
            $table->string('scripture')->nullable();
            $table->text('key_verse')->nullable();
            $table->text('about')->nullable();
            $table->boolean('is_locked')->default(true);
            $table->boolean('is_active')->default(true);
            $table->smallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['speaker_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bible_school_media');
    }
};
