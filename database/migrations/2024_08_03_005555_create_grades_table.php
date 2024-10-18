<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration {

	public function up()
	{
		Schema::create('grades', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->string('name');
			$table->string('note', 255)->nullable();
			$table->unsignedInteger('school_id'); // Change to unsignedInteger
			$table->foreign('school_id')->references('id')->on('schools')->onUpdate('cascade')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('grades');
	}
}