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
        Schema::create('bible_school_event_speaker', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bible_school_event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('speaker_id')->constrained()->cascadeOnDelete();
            $table->unique(['bible_school_event_id', 'speaker_id'], 'bse_event_speaker_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bible_school_event_speaker');
    }
};
