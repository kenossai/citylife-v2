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
        Schema::create('course_lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug');
            $table->unsignedSmallInteger('lesson_number')->default(1);
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->json('quiz_questions')->nullable();
            $table->boolean('is_published')->default(false);
            $table->date('available_date')->nullable();
            $table->timestamps();

            $table->unique(['course_id', 'slug']);
            $table->unique(['course_id', 'lesson_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_lessons');
    }
};
