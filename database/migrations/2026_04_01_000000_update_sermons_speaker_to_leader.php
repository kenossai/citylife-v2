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
        Schema::table('sermons', function (Blueprint $table) {
            $table->dropColumn('speaker');
            $table->foreignId('leader_id')->nullable()->after('title')->constrained('leaders')->nullOnDelete();
            $table->string('guest_speaker_name')->nullable()->after('leader_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->dropForeign(['leader_id']);
            $table->dropColumn(['leader_id', 'guest_speaker_name']);
            $table->string('speaker')->after('title');
        });
    }
};
