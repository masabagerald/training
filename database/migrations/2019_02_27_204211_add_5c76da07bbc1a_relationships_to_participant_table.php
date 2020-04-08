<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c76da07bbc1aRelationshipsToParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participants', function(Blueprint $table) {
            if (!Schema::hasColumn('participants', 'job_title_id')) {
                $table->integer('job_title_id')->unsigned()->nullable();
                $table->foreign('job_title_id', '271689_5c76da04c9c26')->references('id')->on('designations')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participants', function(Blueprint $table) {
            
        });
    }
}
