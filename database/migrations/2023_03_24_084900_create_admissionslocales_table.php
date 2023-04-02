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
        Schema::create('admissionslocales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vi');
            $table->unsignedBigInteger('en');
            $table->foreign('vi')->references('id')->on('admissions');
            $table->foreign('en')->references('id')->on('admissions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissionslocales');
    }
};
