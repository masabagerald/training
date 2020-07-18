<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeFieldsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mentorships', function (Blueprint $table) {
            //
            $table->text('issues_arising')->nullable()->change();
            $table->text('positive_findings')->nullable()->change();
            $table->text('improvement_areas')->nullable()->change();
            $table->text('recommendations')->nullable()->change();
            $table->text('qi_started')->nullable()->change();
            $table->text('notes')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mentorships', function (Blueprint $table) {
            //
        });
    }
}
