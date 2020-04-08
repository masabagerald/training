<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIntervieweesTable extends Migration {

	public function up()
	{
		Schema::create('interviewees', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name');
			$table->string('job_title');
			$table->string('cadre');
			$table->integer('duration_in_service');
			$table->enum('status_of_participant', array('govt', 'project', 'other'));
			$table->string('district');
			$table->string('organization');
			$table->enum('facility_level', array('RRH', 'DistrictHospital', 'HCIII', 'HCII'));
			$table->enum('organization_ownership', array('GOVT', 'NGO', 'PFP', 'Other'));
		});
	}

	public function down()
	{
		Schema::drop('interviewees');
	}
}