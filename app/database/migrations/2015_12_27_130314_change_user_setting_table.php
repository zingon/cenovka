<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUserSettingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("user_settings", function($table) {
			$table->dropIndex("user_settings_contact_id_index");
			$table->dropColumn("contact_id");

			$table->string('name');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('city');
			$table->string('zip_code');
			$table->string('adress');
			$table->string('ic');
			$table->string('dic');
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
			$table->integer("contact_id")->unsigned()->index();

			$table->dropColumn(array("name","firstname","lastname","city","zip_code","address","ic","dic"));
		});
	}

}
