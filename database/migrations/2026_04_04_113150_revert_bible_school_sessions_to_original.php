<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop tables added by the redesign (safe — if they still exist)
        Schema::dropIfExists('bible_school_session_speaker');
        Schema::dropIfExists('bible_school_media');

        // Truncate so we can add NOT NULL columns and FK constraints cleanly
        DB::table('bible_school_sessions')->truncate();

        // Add all original columns that are currently missing
        Schema::table('bible_school_sessions', function (Blueprint $table) {
            // FK on speaker_id (column exists, needs constraint)
            $table->foreign('speaker_id')->references('id')->on('speakers')->cascadeOnDelete();

            $table->string('title')->after('speaker_id');
            $table->string('slug')->after('title');
            $table->string('type')->default('video')->after('slug');
            $table->smallInteger('year')->after('type');
            $table->string('duration', 20)->nullable()->after('year');
            $table->string('youtube_id', 50)->nullable()->after('duration');
            $table->string('audio_file')->nullable()->after('youtube_id');
            $table->string('scripture')->nullable()->after('audio_file');
            $table->text('key_verse')->nullable()->after('scripture');
            $table->text('about')->nullable()->after('key_verse');
            $table->boolean('is_locked')->default(true)->after('about');
            $table->boolean('is_active')->default(true)->after('is_locked');
            $table->smallInteger('sort_order')->default(0)->after('is_active');

            $table->unique(['speaker_id', 'slug'], 'bss_speaker_slug_unique');
        });
    }

    public function down(): void
    {
        // Intentionally left empty
    }
};
