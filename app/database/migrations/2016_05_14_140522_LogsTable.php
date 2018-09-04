<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_log', function ($table) {
            $table->increments('id');
            $table->text('note')->nullable();
            $table->integer('user_id');
            $table->integer('log_state');
            $table->integer('log_type');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('roster')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('activity_log');
	}

}
