<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsEmailAndPhoneToTableContacts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contacts', function($table)
		{
			$table->string('email');
			$table->string('phone');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contacts', function($table)
		{
			$table->dropColumn('email');
			$table->dropColumn('phone');
		});
	}

}
