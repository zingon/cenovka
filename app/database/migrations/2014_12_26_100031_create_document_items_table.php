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

			$table->integer('document_id')->unsigned();
			$table->integer('item_id')->unsigned();

			$table->integer('count');
			$table->integer('discount');
			$table->integer('dph');

			$table->timestamps();
			$table->foreign("document_id")->references("id")->on("documents");
			$table->foreign("item_id")->references("id")->on("items");
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
