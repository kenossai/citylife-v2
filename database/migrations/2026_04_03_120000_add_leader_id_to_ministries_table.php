<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ministries', function (Blueprint $table) {
            $table->foreignId('leader_id')
                ->nullable()
                ->after('id')
                ->constrained('leaders')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('ministries', function (Blueprint $table) {
            $table->dropForeign(['leader_id']);
            $table->dropColumn('leader_id');
        });
    }
};
