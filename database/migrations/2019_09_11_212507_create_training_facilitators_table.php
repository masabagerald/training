<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingFacilitatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_facilitators', function (Blueprint $table) {
            $table->increments('id');

            $table->string('first_name')->nullable();
            $table->integer('facilitator_id')->nullable();
            $table->integer('training_id')->unsigned();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mobile')->nullable();
            $table->enum('sex', array('male', 'female'))->nullable();
            $table->date('dob')->nullable();
            $table->string('health_facility')->nullable();
            $table->string('district')->nullable();
            $table->string('subcounty')->nullable();
            $table->string('parish')->nullable();
            $table->string('profession')->nullable();
           
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_facilitators');
    }
}
