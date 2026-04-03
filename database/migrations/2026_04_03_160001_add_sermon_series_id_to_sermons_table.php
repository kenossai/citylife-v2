<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->foreignId('sermon_series_id')
                ->nullable()
                ->after('id')
                ->constrained('sermon_series')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\SermonSeries::class);
            $table->dropColumn('sermon_series_id');
        });
    }
};
