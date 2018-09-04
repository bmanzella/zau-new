<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BroadcastTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('broadcast', function ($table) {
            $table->increments('id');
            $table->string('subject');
            $table->text('content');
            $table->integer('admin_id');
            $table->tinyInteger('home');
            $table->tinyInteger('visitors');
            $table->tinyInteger('rating_obs');
            $table->tinyInteger('rating_s1');
            $table->tinyInteger('rating_s2');
            $table->tinyInteger('rating_s3');
            $table->tinyInteger('rating_c1');
            $table->tinyInteger('rating_c3');
            $table->tinyInteger('rating_i1');
            $table->tinyInteger('rating_i3');
            $table->tinyInteger('rating_sup');
            $table->tinyInteger('rating_adm');
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
