<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('document_items',function($table){
			$table->increments('id');

			$table->integer('document_id');
			$table->integer('item_id');

			$table->integer('count');
			$table->integer('discount');
			$table->integer('dph');

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
		Schema::drop('document_items');
	}

}
