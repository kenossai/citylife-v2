<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('graduates', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('member_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_enrollment_id')->constrained('course_enrollments')->cascadeOnDelete();
            $table->timestamp('graduated_at')->nullable();
            $table->boolean('certificate_issued')->default(false);
            $table->timestamps();

            // Prevent duplicate graduate records per enrollment
            $table->unique('course_enrollment_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('graduates');
    }
};
