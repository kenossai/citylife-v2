<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('worship_centres', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('name');
            $table->string('address');
            $table->string('landmark')->nullable();
            $table->string('times');
            $table->string('phone')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worship_centres');
    }
};
