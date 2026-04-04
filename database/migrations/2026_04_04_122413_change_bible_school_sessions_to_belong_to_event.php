<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Truncate existing session records (structure is changing)
        DB::table('bible_school_sessions')->truncate();

        Schema::table('bible_school_sessions', function (Blueprint $table) {
            // Must drop FK first, then the unique index that covers it
            $table->dropForeign(['speaker_id']);
            $table->dropUnique('bss_speaker_slug_unique');
            $table->dropColumn('speaker_id');

            // Add relation to BibleSchoolEvent
            $table->foreignId('bible_school_event_id')
                ->after('id')
                ->constrained('bible_school_events')
                ->cascadeOnDelete();

            // New unique: event + slug
            $table->unique(['bible_school_event_id', 'slug'], 'bss_event_slug_unique');
        });
    }

    public function down(): void
    {
        DB::table('bible_school_sessions')->truncate();

        Schema::table('bible_school_sessions', function (Blueprint $table) {
            $table->dropForeign(['bible_school_event_id']);
            $table->dropUnique('bss_event_slug_unique');
            $table->dropColumn('bible_school_event_id');

            $table->foreignId('speaker_id')
                ->after('id')
                ->constrained('speakers')
                ->cascadeOnDelete();

            $table->unique(['speaker_id', 'slug'], 'bss_speaker_slug_unique');
        });
    }
};
