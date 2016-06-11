<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moduls', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('modultype', 255);
            $table->string('modulnev', 255);
            $table->string('note', 255);
            $table->string('ertek1', 255);
            $table->string('ertek2', 255);
            $table->string('ertek3', 255);
            $table->string('ertek4', 255);
            $table->string('ertek5', 255);
            $table->string('ertek6', 255);
            $table->string('ertek7', 255);
            $table->string('ertek8', 255);
            $table->string('ertek9', 255);
            $table->string('ertek10', 255);
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('moduls');
    }
}
