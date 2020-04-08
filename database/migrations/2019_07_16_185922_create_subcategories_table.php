<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubcategoriesTable extends Migration {

	public function up()
	{
		Schema::create('subcategories', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('title');
			$table->integer('category_id')->unsigned()->index();
		});
	}

	public function down()
	{
		Schema::drop('subcategories');
	}
}