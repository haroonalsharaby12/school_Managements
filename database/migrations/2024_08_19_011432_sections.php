<?php

use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        Schema::create('sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Name_Section');
            $table->integer('Status');
            $table->unsignedBigInteger('Grade_id');  // Use unsignedBigInteger for foreign key
            $table->unsignedBigInteger('Class_id'); 
            $table->unsignedInteger('school_id'); // Change to unsignedInteger
			$table->foreign('school_id')->references('id')->on('schools')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('Grade_id')->references('id')->on('grades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Class_id')->references('id')->on('classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
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
