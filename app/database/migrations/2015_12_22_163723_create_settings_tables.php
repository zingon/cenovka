<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::table("contacts",function($table) {
			$table->renameColumn("me","hidden");
		});
		Schema::create("user_settings",function($table) {
			$table->increments("id");

			$table->integer("contact_id")->index();

			$table->timestamps();
		});

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

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table("contacts",function($table) {
			$table->renameColumn("hidden","me");
		});
		Schema::drop('user_settings');
		Schema::drop('contact_settings');
		Schema::drop('item_settings');
		Schema::drop('document_settings');
	}

}
