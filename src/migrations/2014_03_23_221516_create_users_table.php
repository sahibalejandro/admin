<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username', 20);
			$table->string('password', 60);
			$table->timestamps();
		});

		// Insert default admin account.
		DB::insert(
			'insert into users(username,password,created_at,updated_at)values(?,?,NOW(),NOW())',
			array('admin', Hash::make('admin'))
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
