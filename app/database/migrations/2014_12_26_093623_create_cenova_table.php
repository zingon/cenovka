<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenovaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documents', function($table){
			$table->increments('id');

			$table->string('name');
			$table->string('code');

			$table->integer('dodavatel_id');
			$table->integer('odberatel_id');

			$table->date('vystaven');
			$table->date('expire');

			$table->text('note');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('documents');
	}

}
