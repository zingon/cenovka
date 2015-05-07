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
			$table->integer('user_id')->index();
		});	
		Schema::table('categories',function($table){
			$table->integer('user_id')->index();
		});	
		Schema::table('documents',function($table){
			$table->integer('user_id')->index();
		});	
		Schema::table('contacts',function($table){
			$table->integer('user_id')->index();
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
		});
		Schema::table('categories',function($table){
			$table->dropColumn('user_id');
		});
		Schema::table('documents',function($table){
			$table->dropColumn('user_id');
		});
		Schema::table('contacts',function($table){
			$table->dropColumn('user_id');
		});

	}

}
