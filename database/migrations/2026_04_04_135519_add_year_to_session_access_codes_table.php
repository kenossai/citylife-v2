<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('session_access_codes', function (Blueprint $table) {
            $table->smallInteger('year')->nullable()->after('speaker_slug');
        });
    }

    public function down(): void
    {
        Schema::table('session_access_codes', function (Blueprint $table) {
            $table->dropColumn('year');
        });
    }
};
