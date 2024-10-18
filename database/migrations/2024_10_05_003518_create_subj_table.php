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
        Schema::create('sub', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('grade_id')->references('id')->on('Grades')->onDelete('cascade');
            $table->foreignId('classroom_id')->references('id')->on('Classrooms')->onDelete('cascade');
            $table->foreignId('teacher_id')->references('id')->on('Classrooms')->onDelete('cascade');
			// $table->foreignId('school_id')->references('id')->on('schools')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('school_id'); // Change to unsignedInteger
			$table->foreign('school_id')->references('id')->on('schools')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
