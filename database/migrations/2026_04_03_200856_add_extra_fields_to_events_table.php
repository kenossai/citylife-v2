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
        Schema::table('events', function (Blueprint $table) {
            $table->string('location')->nullable()->default('City Life International, Sheffield')->after('description');
            $table->string('category')->nullable()->after('location');
            $table->string('badge')->nullable()->after('category');
            $table->boolean('is_featured')->default(false)->after('badge');
            $table->boolean('requires_registration')->default(true)->after('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['location', 'category', 'badge', 'is_featured', 'requires_registration']);
        });
    }
};
