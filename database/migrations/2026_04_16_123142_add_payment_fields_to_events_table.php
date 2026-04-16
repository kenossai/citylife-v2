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
            $table->boolean('requires_payment')->default(false)->after('requires_registration');
            $table->boolean('show_paypal')->default(true)->after('requires_payment');
            $table->boolean('show_sumup')->default(true)->after('show_paypal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['requires_payment', 'show_paypal', 'show_sumup']);
        });
    }
};
