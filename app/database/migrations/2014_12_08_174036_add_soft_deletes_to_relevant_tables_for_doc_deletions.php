<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletesToRelevantTablesForDocDeletions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('dates', function ($table){
			$table->softDeletes();
		});

		Schema::table('comment_meta', function ($table){
			$table->softDeletes();
		});

		Schema::table('note_meta', function ($table){
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('dates', function($table){
			$table->dropColumn('deleted_at');
		});

		Schema::table('comment_meta', function($table){
			$table->dropColumn('deleted_at');
		});

		Schema::table('note_meta', function($table){
			$table->dropColumn('deleted_at');
		});
	}

}
