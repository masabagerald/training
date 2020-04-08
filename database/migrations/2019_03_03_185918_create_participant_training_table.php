<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_training', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('participant_id')->unsigned();
            $table->integer('training_id')->unsigned();
            $table->foreign('participant_id')->references('id')->on('participants')
                ->onDelete('cascade');

            $table->foreign('training_id')->references('id')->on('trainings')
                ->onDelete('cascade');
            $table->string('remarks')->nullable();
            $table->string('comments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participant_training');
    }
}
