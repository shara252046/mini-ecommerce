<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('unit')->default('piece')->after('price');
            $table->boolean('is_fresh')->default(0)->after('unit');
            $table->date('expiry_date')->nullable()->after('is_fresh');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['unit', 'is_fresh', 'expiry_date']);
        });
    }
};