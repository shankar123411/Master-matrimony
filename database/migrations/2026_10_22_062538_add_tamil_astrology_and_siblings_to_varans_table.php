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
        Schema::table('varans', function (Blueprint $table) {
            $table->string('brothers')->nullable()->after('siblings_details');
            $table->string('sisters')->nullable()->after('brothers');
            $table->string('tamil_month')->nullable()->after('dosham');
            $table->string('tamil_year')->nullable()->after('tamil_month');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('varans', function (Blueprint $table) {
            $table->dropColumn(['brothers', 'sisters', 'tamil_month', 'tamil_year']);
        });
    }
};
