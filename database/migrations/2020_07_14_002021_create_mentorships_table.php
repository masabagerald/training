<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentorshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentorships', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('srart_date');
            $table->string('end_date');
            $table->string('facility_name');
            $table->text('issues_arising');
            $table->text('positive_findings');
            $table->text('improvement_areas');
            $table->text('recommendations');
            $table->text('qi_started');
            $table->text('notes');


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
        Schema::dropIfExists('mentorships');
    }
}
