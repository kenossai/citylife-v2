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
        Schema::create('homepage_music', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('');
            $table->string('artist')->nullable();
            $table->string('url')->default('');
            $table->boolean('is_active')->default(false);
            $table->boolean('autoplay')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_music');
    }
};
