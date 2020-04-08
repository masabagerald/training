<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('training_name');
            $table->string('training_id')->nullable();
            $table->string('training_type')->nullable();
            $table->string('training_objectives');
            $table->string('training_venue');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('expected_outcome');
            $table->text('challenges');
            $table->text('recommendation');
            $table->string('participants_list')->nullable();
            $table->string('facilitators_list')->nullable();
            $table->string('captured_by');
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
        Schema::dropIfExists('reports');
    }
}
