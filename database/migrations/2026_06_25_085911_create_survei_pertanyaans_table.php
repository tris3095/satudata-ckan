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
        Schema::create('survei_pertanyaans', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 5)->nullable();
            $table->text('pertanyaan');
            $table->enum('tipe', ['skala', 'ya_tidak', 'teks'])->default('skala');
            $table->integer('urutan')->default(0);
            $table->boolean('is_conditional')->default(false);
            $table->boolean('is_required')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survei_pertanyaans');
    }
};
