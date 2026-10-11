<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('delivery_slot')->default('morning')->after('status');
            $table->string('delivery_area')->nullable()->after('delivery_slot');
            $table->decimal('delivery_charge', 10, 2)->default(0)->after('delivery_area');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['delivery_slot', 'delivery_area', 'delivery_charge']);
        });
    }
};