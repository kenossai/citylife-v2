<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Convert any existing plain-string values to a single-element JSON array
        // so no data is lost during the column type change.
        DB::table('sermons')
            ->whereNotNull('scripture')
            ->where('scripture', 'not like', '[%')
            ->get(['id', 'scripture'])
            ->each(function ($row) {
                DB::table('sermons')
                    ->where('id', $row->id)
                    ->update(['scripture' => json_encode([$row->scripture])]);
            });

        Schema::table('sermons', function (Blueprint $table) {
            $table->json('scripture')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->string('scripture')->nullable()->change();
        });
    }
};
