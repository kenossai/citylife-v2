<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropForeign(['leader_id']);
            $table->dropColumn('leader_id');
            $table->string('head_type', 50)->nullable()->after('id');
            $table->unsignedBigInteger('head_id')->nullable()->after('head_type');
            $table->index(['head_type', 'head_id']);
        });
    }

    public function down(): void
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropIndex(['head_type', 'head_id']);
            $table->dropColumn(['head_type', 'head_id']);
            $table->foreignId('leader_id')->nullable()->constrained()->nullOnDelete();
        });
    }
};
