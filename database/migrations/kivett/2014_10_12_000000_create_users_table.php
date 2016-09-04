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
            $table->string('privilegium');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('reminder',50)->nullable();
            $table->string('old_password');
            $table->string('cim_irsz');
            $table->string('cim_varos');
            $table->string('cim_cim');
            $table->string('cim_telefon');

            $table->rememberToken();
            $table->boolean('archived')->default(0);
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
        Schema::drop('users');
    }
}
