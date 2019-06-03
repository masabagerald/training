<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreviousTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previous_trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('participant_id')->nullable();
            $table->string('training')->nullable();
            $table->date('date')->nullable();
            $table->string('organization')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('previous_trainings');
    }
}
