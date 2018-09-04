<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Training extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('training_assigned_exams', function($table) {
			$table->increments('id');
			$table->integer('controller_id');
			$table->integer('exam_id');
			$table->integer('instructor_id');
			$table->integer('complete');
			$table->timestamps();
		});

		Schema::create('training_mentor_availability', function($table) {
			$table->increments('id');
			$table->integer('mentor_id');
			$table->string('slot');
			$table->integer('trainee_id')->nullable();
			$table->integer('position_id')->nullable();
			$table->text('trainee_comments');
			$table->timestamps();
		});

		Schema::create('training_ots_request', function($table) {
			$table->increments('id');
			$table->integer('controller_id');
			$table->integer('position');
			$table->integer('complete');
			$table->integer('requested_by');
			$table->timestamps();
		});

		Schema::create('training_notes', function($table) {
			$table->increments('id');
			$table->integer('controller_id');
			$table->integer('instructor_id');
			$table->integer('position');
			$table->integer('type');
			$table->text('comments');
			$table->string('date');
			$table->string('session_begin');
			$table->integer('duration');
			$table->timestamps();
		});

		Schema::create('training_controller_requests', function($table) {
			$table->increments('id');
			$table->integer('controller_id');
			$table->integer('position');
			$table->string('date');
			$table->string('request_begin');
			$table->string('request_end');
			$table->text('comments');
			$table->integer('accepted');
			$table->integer('mentor');
			$table->string('session_begin');
			$table->string('session_end');
			$table->integer('complete');
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
