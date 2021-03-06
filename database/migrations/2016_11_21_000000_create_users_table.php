<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('company_id')->unsigned();
            $table->string('group_name')->nullable();
            $table->date('dob')->nullable();
            $table->string('mobile_number');
            $table->integer('role_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();


            $table->foreign('role_id')
                  ->references('id')
                  ->on('roles');

            $table->foreign('company_id')
                  ->references('id')
                  ->on('company');

            $table->unique('id', 'company_id');
        });
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
