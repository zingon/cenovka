<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveDodavatelIdFromDocumentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("documents",function($table) {
			$table->dropForeign('documents_dodavatel_id_foreign');
			$table->dropColumn('dodavatel_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table("documents",function($table) {
			$table->integer('dodavatel_id')->unsigned();
			$table->foreign("dodavatel_id")->reference("id")->on("contacts");
		});
	}

}
