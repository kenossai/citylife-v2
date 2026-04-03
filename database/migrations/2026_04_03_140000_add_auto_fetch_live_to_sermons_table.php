<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->boolean('auto_fetch_live')->default(false)->after('is_live')
                ->comment('When true, the scheduler will auto-fetch the YouTube live stream URL on Sundays at 11:15 AM');
        });
    }

    public function down(): void
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->dropColumn('auto_fetch_live');
        });
    }
};
