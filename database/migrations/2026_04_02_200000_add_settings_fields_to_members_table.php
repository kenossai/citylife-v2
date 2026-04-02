<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->text('bio')->nullable()->after('notes');
            $table->boolean('notify_study_reminders')->default(true)->after('bio');
            $table->boolean('notify_quiz_results')->default(true)->after('notify_study_reminders');
            $table->boolean('notify_weekly_digest')->default(true)->after('notify_quiz_results');
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn(['bio', 'notify_study_reminders', 'notify_quiz_results', 'notify_weekly_digest']);
        });
    }
};
