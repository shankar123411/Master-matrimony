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
            if (!Schema::hasColumn('varans', 'reg_no')) {
                $table->string('reg_no')->nullable()->after('varan_type');
            }
            if (!Schema::hasColumn('varans', 'reg_date')) {
                $table->date('reg_date')->nullable()->after('reg_no');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('varans', function (Blueprint $table) {
            if (Schema::hasColumn('varans', 'reg_no')) {
                $table->dropColumn('reg_no');
            }
            if (Schema::hasColumn('varans', 'reg_date')) {
                $table->dropColumn('reg_date');
            }
        });
    }
};
