<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Roster extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roster', function($table) {
			$table->integer('id')->unsigned();
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email');
			$table->integer('rating_id');
			$table->integer('canTrain');
			$table->integer('visitor');
			$table->string('visitor_from')->nullable();
			$table->integer('status');
			$table->string('remember_token')->nullable();
			$table->integer('loa');
			$table->integer('del');
			$table->integer('gnd');
			$table->integer('twr');
			$table->integer('app');
			$table->integer('ctr');
		});

		Schema::create('announcements', function($table) {
			$table->increments('id');
			$table->text('message');
			$table->integer('class');
			$table->integer('active');
			$table->integer('admin_id');
			$table->timestamps();
		});

		Schema::create('visit_requests', function($table) {
			$table->increments('id');
			$table->string('cid');
			$table->string('first_name');
			$table->string('last_name');
			$table->integer('rating_id');
			$table->string('email');
			$table->string('home');
			$table->integer('accepted');
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
