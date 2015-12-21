<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddModuleIdCellToSettingTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table("settings", function ($table) {
			$table->integer("module_id")->unsigned()->index();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

		Schema::table("settings", function ($table) {
			$table->dropColumn("module_id");
		});

	}
}
