<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToSettingTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("user_settings",function($table) {
			$table->integer("user_id")->index();
		});

		Schema::table("contact_settings",function($table) {
			$table->integer("user_id")->index();
		});


		Schema::table("item_settings",function($table) {
			$table->integer("user_id")->index();
		});

		Schema::table("document_settings",function($table) {
			$table->integer("user_id")->index();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table("user_settings",function($table) {

			$table->dropColumn("user_id");
		});

		Schema::table("contact_settings",function($table) {
			$table->dropColumn("user_id");
		});


		Schema::table("item_settings",function($table) {
			$table->dropColumn("user_id");
		});

		Schema::table("document_settings",function($table) {
			$table->dropColumn("user_id");
		});
	}

}
