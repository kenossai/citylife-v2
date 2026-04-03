<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->boolean('is_upcoming')->default(false)->after('is_featured');
            $table->boolean('is_live')->default(false)->after('is_upcoming');
            $table->string('youtube_channel_id')->nullable()->after('is_live')
                ->comment('YouTube channel/handle used to auto-embed live stream when is_live is on');
        });
    }

    public function down(): void
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->dropColumn(['is_upcoming', 'is_live', 'youtube_channel_id']);
        });
    }
};
