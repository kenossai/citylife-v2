<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leader_mission_pillar', function (Blueprint $table) {
            $table->foreignId('mission_pillar_id')->constrained()->cascadeOnDelete();
            $table->foreignId('leader_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->primary(['mission_pillar_id', 'leader_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leader_mission_pillar');
    }
};
