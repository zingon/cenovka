<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnCellValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('own_cell_values', function($table){
			$table->increments('id');

			$table->integer('own_cell_id')->index();
			$table->integer('document_id')->index();

			$table->string('value');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('own_cell_values');
	}

}