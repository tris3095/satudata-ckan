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
        Schema::table('produk_statistiks', function (Blueprint $table) {

            $table->string('thumbnail')->nullable()->after('slug');
            $table->string('isbn')->nullable()->after('thumbnail');
            $table->string('nomor_katalog')->nullable()->after('isbn');
            $table->string('frekuensi_terbit')->nullable()->after('nomor_katalog');

            $table->string('bahasa')->nullable()->after('tanggal_rilis');
            $table->string('file_size')->nullable()->after('bahasa');



            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk_statistiks', function (Blueprint $table) {
            //
        });
    }
};
