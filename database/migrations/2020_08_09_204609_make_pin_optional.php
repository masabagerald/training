<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakePinOptional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function __construct()
{
    DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
}
    public function up()
    {
        Schema::table('participants', function (Blueprint $table) {
            //
            $table->string('pin')->nullable()->change();
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
