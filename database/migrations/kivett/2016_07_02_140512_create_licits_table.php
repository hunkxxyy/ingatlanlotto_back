<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licits', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('ingatlan_id')->unsigned();
            $table->foreign('ingatlan_id')->references('id')->on('ingatlandb');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('code');
            $table->boolean('jovahagyva')->default(false);

            $table->boolean('fake')->default(false);
            $table->boolean('archived')->default(false);
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
        Schema::drop('licits');
    }
}
