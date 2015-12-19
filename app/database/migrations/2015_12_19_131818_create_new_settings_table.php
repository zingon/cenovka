<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("settings",function($table) {
			$table->increments("id");
			$table->string("module");
			$table->string("module_name");
			$table->string("key");
			$table->string("key_name");
			$table->string("type");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("settings");
	}

}
