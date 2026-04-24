<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            // Extended address fields
            $table->string('address_line_2')->nullable()->after('address');
            $table->string('county')->nullable()->after('city');

            // ChurchSuite communication preferences
            $table->boolean('receive_general_email')->default(false)->after('country');
            $table->boolean('receive_general_sms')->default(false)->after('receive_general_email');
            $table->boolean('receive_rota_email')->default(false)->after('receive_general_sms');
            $table->boolean('receive_rota_sms')->default(false)->after('receive_rota_email');

            // Data protection acceptance
            $table->boolean('data_protection_accepted')->default(false)->after('receive_rota_sms');
            $table->timestamp('data_protection_accepted_at')->nullable()->after('data_protection_accepted');
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn([
                'address_line_2',
                'county',
                'receive_general_email',
                'receive_general_sms',
                'receive_rota_email',
                'receive_rota_sms',
                'data_protection_accepted',
                'data_protection_accepted_at',
            ]);
        });
    }
};
