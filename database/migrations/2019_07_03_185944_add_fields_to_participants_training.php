<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToParticipantsTraining extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participant_training', function (Blueprint $table) {
            //
			$table->string('job_title')->nullable();
			$table->string('facility')->nullable();
			$table->string('profession')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participant_training', function (Blueprint $table) {
            //
        });
    }
}
