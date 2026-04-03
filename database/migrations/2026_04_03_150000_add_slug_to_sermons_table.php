<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->string('slug', 200)->nullable()->after('title');
        });

        // Back-fill slugs for existing rows so the unique constraint can be applied
        \DB::table('sermons')->orderBy('id')->each(function ($row) {
            $base = Str::slug($row->title);
            $slug = $base;
            $i    = 1;
            while (\DB::table('sermons')->where('slug', $slug)->where('id', '!=', $row->id)->exists()) {
                $slug = $base . '-' . $i++;
            }
            \DB::table('sermons')->where('id', $row->id)->update(['slug' => $slug]);
        });

        Schema::table('sermons', function (Blueprint $table) {
            $table->string('slug', 200)->unique()->change();
        });
    }

    public function down(): void
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
