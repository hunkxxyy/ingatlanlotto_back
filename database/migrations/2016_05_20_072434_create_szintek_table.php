<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSzintekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('szintek', function (Blueprint $table){

        $table->increments('id');
        $table->integer('parent')->unsigned();
        $table->string('nev', 255);
        $table->string('tipus', 255);
        $table->string('file', 255)->nullable();;
        $table->text('szoveg')->nullable();;
            $table->string('focim', 255)->nullable();;
            $table->string('datum', 30)->nullable();;
            $table->text('preview', 255)->nullable();;
            $table->integer('pos')->nullable();
            $table->string('link', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('keywords', 255)->nullable();
            $table->text('description', 255)->nullable();
            $table->string('termekMeret', 255)->nullable();


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
        Schema::drop('szintek');
    }
}
