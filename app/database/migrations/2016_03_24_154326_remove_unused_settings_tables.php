<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUnusedSettingsTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists("contact_settings");
		Schema::dropIfExists("document_settings");
		Schema::dropIfExists("item_settings");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		
		Schema::create("contact_settings",function($table) {
			$table->increments("id");

			$table->timestamps();
		});


		Schema::create("item_settings",function($table) {
			$table->increments("id");

			$table->timestamps();
		});

		Schema::create("document_settings",function($table) {
			$table->increments("id");

			$table->timestamps();
		});
	}


}
