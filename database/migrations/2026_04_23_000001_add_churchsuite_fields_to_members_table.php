<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('churchsuite_id')->nullable()->after('notes');
            $table->timestamp('churchsuite_synced_at')->nullable()->after('churchsuite_id');
            $table->string('churchsuite_sync_status')->nullable()->after('churchsuite_synced_at'); // synced|failed|pending
            $table->text('churchsuite_sync_error')->nullable()->after('churchsuite_sync_status');
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn([
                'churchsuite_id',
                'churchsuite_synced_at',
                'churchsuite_sync_status',
                'churchsuite_sync_error',
            ]);
        });
    }
};
