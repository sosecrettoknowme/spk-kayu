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
        Schema::create('data_penilaians', function (Blueprint $table) {
            $table->id();
            $table->string('kode_penilaian');
            $table->foreignId('alternative_id');
            $table->foreignId('subkriteria_id');
            $table->json('penilaian')->default('[]');
            $table->date('tanggal_penilaian')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_penilaians');
    }
};
