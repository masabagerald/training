<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeHealthFacilityToInt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

 
    public function up()
    {
        Schema::table('participants', function (Blueprint $table) {
            //
            $table->integer('health_facility')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participants', function (Blueprint $table) {
            //
        });
    }
}
