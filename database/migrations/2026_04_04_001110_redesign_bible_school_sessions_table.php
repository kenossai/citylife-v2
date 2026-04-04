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
        Schema::table('bible_school_sessions', function (Blueprint $table) {
            // Drop old columns
            $table->dropForeign(['speaker_id']);
            $table->dropColumn([
                'speaker_id', 'title', 'slug', 'type', 'year', 'duration',
                'youtube_id', 'audio_file', 'scripture', 'key_verse',
                'about', 'is_locked', 'is_active', 'sort_order',
            ]);

            // Add new columns
            $table->text('morning')->nullable()->after('id');
            $table->text('afternoon')->nullable()->after('morning');
            $table->text('evening')->nullable()->after('afternoon');
            $table->string('status')->default('upcoming')->after('evening');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bible_school_sessions', function (Blueprint $table) {
            $table->dropColumn(['morning', 'afternoon', 'evening', 'status']);
        });
    }
};
