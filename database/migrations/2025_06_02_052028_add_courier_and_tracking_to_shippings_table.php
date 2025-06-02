<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shippings', function (Blueprint $table) {
            $table->dateTime('courier_schedule')->nullable()->after('shipping_date');
            $table->string('tracking_number')->nullable()->after('courier_schedule');
        });
    }

    public function down(): void
    {
        Schema::table('shippings', function (Blueprint $table) {
            $table->dropColumn(['courier_schedule', 'tracking_number']);
        });
    }
};
