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
        Schema::create('data_perhitungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_penilaian_id');
            // $table->foreignId('data_penilaian_id')->constrained('data_penilaians');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_perhitungans');
    }
};
