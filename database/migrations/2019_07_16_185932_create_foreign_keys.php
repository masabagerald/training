<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('assessments', function(Blueprint $table) {
			$table->foreign('interviewee_id')->references('id')->on('interviewees')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('subcategories', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('assessments', function(Blueprint $table) {
			$table->dropForeign('assessments_interviewee_id_foreign');
		});
		Schema::table('subcategories', function(Blueprint $table) {
			$table->dropForeign('subcategories_category_id_foreign');
		});
	}
}