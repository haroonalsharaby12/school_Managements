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
        //
        Schema::create('teacher_section',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('Cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('Cascade');
            $table->unsignedInteger('school_id'); // Change to unsignedInteger
			$table->foreign('school_id')->references('id')->on('schools')->onUpdate('cascade')->onDelete('cascade');

			// $table->foreignId('school_id')->references('id')->on('schools')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
