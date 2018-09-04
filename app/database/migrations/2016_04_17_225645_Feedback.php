<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FeedbackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('feedback',function($table)
		{
			$table->integer('controller_id');
			$table->string('position');
			$table->string('level');
			$table->text('comments');
			$table->text('staff_comments');
			$table->integer('status');
			$table->string('pilot_name');
			$table->string('pilot_id');
			$table->string('pilot_email');
			$table->string('flight_callsign');
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
