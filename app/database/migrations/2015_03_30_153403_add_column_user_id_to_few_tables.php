<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUserIdToFewTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('items',function($table){
			$table->integer('user_id')->unsigned();
			$table->foreign("user_id")->references("id")->on("users");
		});	
		Schema::table('categories',function($table){
			$table->integer('user_id')->unsigned();
			$table->foreign("user_id")->references("id")->on("users");
		});	
		Schema::table('documents',function($table){
			$table->integer('user_id')->unsigned();
			$table->foreign("user_id")->references("id")->on("users");
		});	
		Schema::table('contacts',function($table){
			$table->integer('user_id')->unsigned();
			$table->foreign("user_id")->references("id")->on("users");
		});	

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('items',function($table){
			$table->dropColumn('user_id');
			$table->dropForeign("items_user_id_foreign");
		});
		Schema::table('categories',function($table){
			$table->dropColumn('user_id');
			$table->dropForeign("categories_user_id_foreign");
		});
		Schema::table('documents',function($table){
			$table->dropColumn('user_id');
			$table->dropForeign("documents_user_id_foreign");
		});
		Schema::table('contacts',function($table){
			$table->dropColumn('user_id');
			$table->dropForeign("contacts_user_id_foreign");
		});

	}

}
