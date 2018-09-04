<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Airports extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('airports', function($table)
		{
			$table->string('id');
			$table->string('name');
			$table->string('iata');
		});

		Schema::create('weather', function($table) {
			$table->string('id');
			$table->string('type');
			$table->string('wind');
			$table->string('baro');
			$table->string('metar');

		});

		Schema::create('scenery', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->text('description');
			$table->string('type');
			$table->string('link');
			$table->timestamps();
		});

		Schema::create('comms_airport', function($table)
		{
			$table->increments('id');
			$table->string('position');
			$table->string('name');
			$table->string('facility');
			$table->string('frequency');
			$table->string('type');
			$table->string('pofid');
			$table->timestamps();
		});

		Schema::create('comms_atis', function($table)
		{
			$table->increments('id');
			$table->string('position');
			$table->string('name');
			$table->string('facility');
			$table->string('frequency');
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
