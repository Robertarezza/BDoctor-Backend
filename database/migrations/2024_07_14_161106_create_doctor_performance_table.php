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
        Schema::create('doctor_performance', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id')->index();
            $table->foreign('doctor_id')->references('id')->on('doctors')->cascadeOnDelete();
            $table->unsignedBigInteger('performance_id')->index();
            $table->foreign('performance_id')->references('id')->on('performances')->cascadeOnDelete();

            $table->primary(['doctor_id', 'performance_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_performance');
    }
};
