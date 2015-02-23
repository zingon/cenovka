<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts', function($table){
			$table->increments('id');

			$table->string('name');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('city');
			$table->string('zip_code');
			$table->string('adress');
			$table->string('ic');
			$table->string('dic');

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
		Schema::drop('contacts');
	}

}
