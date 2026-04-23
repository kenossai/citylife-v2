<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_lessons', function (Blueprint $table): void {
            $table->text('reschedule_reason')->nullable()->after('available_date');
        });
    }

    public function down(): void
    {
        Schema::table('course_lessons', function (Blueprint $table): void {
            $table->dropColumn('reschedule_reason');
        });
    }
};
