<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('matrimony_master_options')) {
            Schema::create('matrimony_master_options', function (Blueprint $table) {
                $table->id();
                $table->string('category', 50); // 'community', 'education', 'job'
                $table->string('name_ta', 255);
                $table->string('name_en', 255)->nullable();
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('matrimony_master_options');
    }
};
