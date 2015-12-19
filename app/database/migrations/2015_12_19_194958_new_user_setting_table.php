<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewUserSettingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("setting_user", function($table) {
			$table->increments("id");
			$table->integer("setting_id")->unsigned()->index();
			$table->integer("user_id")->unsigned()->index();
			$table->string("value");

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
		Schema::dropIfExists("setting_user");
	}

}
