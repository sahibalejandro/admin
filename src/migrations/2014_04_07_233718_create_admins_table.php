<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admins', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username', 20);
			$table->string('name', 50);
			$table->string('password', 60);
			$table->tinyInteger('active')->default(1);
			$table->tinyInteger('super_admin')->default(0);
			$table->timestamps();
		});

		// Insert default admin account.
		DB::insert(
			'insert into admins(username,name,password,super_admin,created_at,updated_at)values(?,?,?,1,NOW(),NOW())',
			array('admin', 'Admin', Hash::make('admin'))
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admins');
	}

}
