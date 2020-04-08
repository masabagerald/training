<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentSubcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_subcategory', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('asessment_id')->unsigned();
            $table->integer('subcategory_id')->unsigned();
            $table->string('how_often')->nullable();
            $table->string('previous_attendance')->nullable();
            $table->string('mentorship')->nullable();
            $table->string('better_quality')->nullable();
            $table->string('recommend_others')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessment_subcategory');
    }
}
