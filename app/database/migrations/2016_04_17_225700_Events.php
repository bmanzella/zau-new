a<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventsTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event',function($table)
		{
			$table->increments('id');
			$table->string('title');
			$table->dateTime('event_start');
			$table->dateTime('event_end');
			$table->text('banner_link');
			$table->text('description');
			$table->string('host');
			$table->integer('status');
			$table->timestamps();
		});

		Schema::create('event_positions',function($table)
		{
			$table->increments('id');
			$table->integer('event_id');
      $table->string('name');
			$table->string('event_start');
			$table->integer('controller_id');
			$table->integer('order_index');
		});

		Schema::create('event_position_requests',function($table)
		{
			$table->integer('event_id');
			$table->integer('position_id');
			$table->integer('controller_id');
			$table->integer('done');
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
