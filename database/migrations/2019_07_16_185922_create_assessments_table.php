<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssessmentsTable extends Migration {

	public function up()
	{
		Schema::create('assessments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->date('date');
			$table->string('department');
			$table->longText('challenges');
			$table->string('recommendation');
			$table->integer('interviewee_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('assessments');
	}
}