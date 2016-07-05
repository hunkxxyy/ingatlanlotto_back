<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngatlanokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingatlandb', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ingatlan_azoosito');
            $table->integer('pos');
            $table->string('tulaj',255);
            $table->string('tulaj_varos',255);
            $table->string('tulaj_irsz',10);
            $table->string('tulaj_cim',255);
            $table->string('tulaj_email',255);
            $table->string('tulaj_telefon',40);
            $table->string('ingatlan_varos',255);
            $table->string('ingatlan_irsz',10);
            $table->string('ingatlan_cim',255);
            $table->integer('ingatlan_telek_nm2');
            $table->integer('ingatlan_nm2');
            $table->integer('ingatlan_kategoria');
            $table->integer('ingatlan_szobak');
            $table->integer('ingatlan_garazs');
            $table->integer('szazalek_ertekesitve');


            $table->integer('ingatlan_ar')->nullable();;
            $table->integer('sorsjegy_ar')->nullable();
            $table->integer('eladas_szazalek')->nullable();
            $table->text('ingatlan_leiras');

            $table->boolean('archived')->default(false);
         //   $table->string('kep',255);
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
        Schema::drop('ingatlandb');
    }
}
