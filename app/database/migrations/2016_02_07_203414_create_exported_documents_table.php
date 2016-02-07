<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExportedDocumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("exported_documents", function($table) {
			$table->increments("id");

			$table->mediumText("document");

			$table->integer("document_id")->unsigned();
			$table->foreign("document_id")->references("id")->on("documents");

			$table->softDeletes();
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
		Schema::dropIfExists("exported_documents");
	}

}
