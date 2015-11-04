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

			$table->integer('dodavatel_id')->unsigned();
			$table->integer('odberatel_id')->unsigned();

			$table->date('vystaven');
			$table->date('expire');

			$table->text('note');
			$table->softDeletes();
			$table->timestamps();

			$table->foreign("dodavatel_id")->references("id")->on("contacts");
			$table->foreign("odberatel_id")->references("id")->on("contacts");
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
