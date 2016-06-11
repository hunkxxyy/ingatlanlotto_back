<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngatlanKepek extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingatlan_kepek', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('ingatlan_id')->unsigned();
            $table->foreign('ingatlan_id')->references('id')->on('ingatlandb');
            $table->string('name', 500);
            $table->integer('pos');
            $table->string('file', 255);
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
        Schema::drop('ingatlan_kepek');
    }
}
