<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1551292929ParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('participants')) {
            Schema::create('participants', function (Blueprint $table) {
                $table->increments('id');
                $table->string('first_name')->nullable();
                $table->string('middle_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('mobile')->nullable();
                $table->enum('sex', array('male', 'female'))->nullable();
                $table->date('dob')->nullable();
                $table->string('health_facility')->nullable();
                $table->string('postal_address')->nullable();
                $table->string('physical_addr_address')->nullable();
                $table->double('physical_addr_latitude')->nullable();
                $table->double('physical_addr_longitude')->nullable();
                $table->string('district')->nullable();
                $table->string('subcounty')->nullable();
                $table->string('parish')->nullable();
                $table->string('profession')->nullable();
                $table->string('previous_training')->nullable();
                $table->string('education_level')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
