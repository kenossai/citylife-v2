<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mission_countries', function (Blueprint $table) {
            $table->id();
            $table->string('flag', 20)->nullable();
            $table->string('name', 100);
            $table->string('region', 150)->nullable();
            $table->enum('type', ['home', 'abroad'])->default('abroad');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mission_countries');
    }
};
