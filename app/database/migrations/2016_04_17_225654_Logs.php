<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Logs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('controller_log',function($table)
		{
			$table->integer('cid');
			$table->string('date');
			$table->string('start');
			$table->string('duration');
			$table->string('position');
			$table->string('streamupdate');
		});

		Schema::create('atc_online',function($table)
		{
			$table->string('atc');
			$table->string('freq');
			$table->string('name');
			$table->string('cid');
			$table->string('rango');
			$table->string('atis');
			$table->string('starttime');
		});

		Schema::create('pilots_online',function($table)
		{
			$table->string('callsign');
			$table->string('cid');
			$table->string('real_name');
			$table->string('real_alt');
			$table->string('ground_speed');
			$table->string('aircraft_type');
			$table->string('planned_cruise');
			$table->string('dep_apt');
			$table->string('arr_apt');
			$table->string('status');
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
