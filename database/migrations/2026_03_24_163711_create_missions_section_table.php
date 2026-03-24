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
        Schema::create('missions_section', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow')->nullable();
            $table->string('heading');
            $table->text('description')->nullable();
            $table->json('stats')->nullable();               // [{"value":"15+","label":"Mission Partners"}, ...]
            $table->string('btn_text')->nullable();
            $table->string('btn_url')->nullable();
            $table->json('images')->nullable();              // ["path/image1.jpg", ...]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions_section');
    }
};
