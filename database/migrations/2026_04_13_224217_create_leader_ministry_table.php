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
        Schema::create('leader_ministry', function (Blueprint $table) {
            $table->foreignId('ministry_id')->constrained()->cascadeOnDelete();
            $table->foreignId('leader_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->primary(['ministry_id', 'leader_id']);
        });

        // Drop the now-redundant single leader_id FK column
        Schema::table('ministries', function (Blueprint $table) {
            $table->dropForeign(['leader_id']);
            $table->dropColumn('leader_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leader_ministry');

        Schema::table('ministries', function (Blueprint $table) {
            $table->foreignId('leader_id')
                ->nullable()
                ->after('id')
                ->constrained('leaders')
                ->nullOnDelete();
        });
    }
};
