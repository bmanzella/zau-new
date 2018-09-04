<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Documents extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('document', function($table) 
		{
			$table->increments('id');
			$table->string('name');
			$table->text('comments');
			$table->string('type');
			$table->string('url');
			$table->timestamps();
		});

		Schema::create('training_files', function($table) 
		{
			$table->increments('id');
			$table->string('name');
			$table->text('comments');
			$table->string('type');
			$table->string('url');
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
		//
	}

}
