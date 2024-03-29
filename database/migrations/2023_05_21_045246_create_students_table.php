<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('birthdate');
            $table->string('age');
            $table->string('address');
            $table->string('contact_number');
            $table->foreignId('grade_level_id');
            $table->foreignId('strand_id');
            $table->string('status')->default(0);
            $table->string('student_profile')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
