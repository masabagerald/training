<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1551556152ParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participants', function (Blueprint $table) {
            
if (!Schema::hasColumn('participants', 'comments')) {
                $table->text('comments')->nullable();
                }
if (!Schema::hasColumn('participants', 'photo')) {
                $table->string('photo')->nullable();
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
        Schema::table('participants', function (Blueprint $table) {
            $table->dropColumn('comments');
            $table->dropColumn('photo');
            
        });

    }
}
