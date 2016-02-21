<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDocumentTemplateIdColumnToDocumentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("documents",function($table) {
			$table->integer("document_template_id")->unsigned()->index();
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
			$table->dropIndex('documents_document_template_id_index');
			$table->dropColumn('document_template_id');
		});
	}

}
