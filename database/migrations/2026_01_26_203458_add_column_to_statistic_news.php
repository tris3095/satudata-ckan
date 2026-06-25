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
        Schema::table('statistic_news', function (Blueprint $table) {
            $table->string('size', 100)->nullable()->after('materi');
            $table->date('rilis_date')->nullable()->after('size');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('statistic_news', function (Blueprint $table) {
            //
        });
    }
};
