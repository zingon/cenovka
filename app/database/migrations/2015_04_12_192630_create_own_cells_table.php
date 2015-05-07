<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnCellsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('own_cells',function($table){
			$table->increments('id');

			$table->integer('type_id')->index();
			$table->integer('user_id')->index();

			$table->string('name');
			$table->string('tight_name');
			$table->string('default_value');

			$table->integer('poradi')->index();
			$table->tinyInteger('use');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('own_cells');
	}

}
