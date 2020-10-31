<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEmersonTestesTable.
 */
class CreateEmersonTestesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emerson_testes', function(Blueprint $table) {
            $table->increments('id');
			$table->increments('user_name');
			$table->increments('user_email');
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
		Schema::drop('emerson_testes');
	}
}
