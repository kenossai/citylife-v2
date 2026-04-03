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
        Schema::create('bible_school_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('speaker_id')->constrained('speakers')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug');
            $table->enum('type', ['video', 'audio'])->default('video');
            $table->unsignedSmallInteger('year')->default(date('Y'));
            $table->string('duration', 20)->nullable();
            $table->string('youtube_id', 50)->nullable();
            $table->string('audio_file')->nullable();
            $table->string('scripture', 255)->nullable();
            $table->text('key_verse')->nullable();
            $table->text('about')->nullable();
            $table->boolean('is_locked')->default(true);
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['speaker_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bible_school_sessions');
    }
};
