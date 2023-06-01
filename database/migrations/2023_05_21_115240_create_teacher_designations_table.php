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
        Schema::create('teacher_designations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id');
            $table->string('assigned_as');
            $table->foreignId('strand_id')->nullable();
            $table->foreignId('subject_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_designations');
    }
};
