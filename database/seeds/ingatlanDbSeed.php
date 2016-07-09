<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class ingatlanDbSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

         for ($i=1 ;$i<30 ;$i++)
         {
             $ar=$faker->numberBetween(1000000,40000000);
             DB::table('ingatlandb')->insert([

                 'ingatlan_azoosito' => $i,
                 'pos' => $i,
                 'tulaj' => $faker->name,
                 'tulaj_varos' => $faker->city,
                 'tulaj_irsz' => $faker->numberBetween(1100,8888),
                 'tulaj_cim' => $faker->address,
                 'tulaj_email' => $faker->email,
                 'tulaj_telefon' => $faker->phoneNumber,

                 'ingatlan_varos' => $faker->city,
                 'ingatlan_irsz' => $faker->numberBetween(1100,8888),
                 'ingatlan_cim' => $faker->address,
                 'ingatlan_telek_nm2' => $faker->numberBetween(50,999),
                 'ingatlan_nm2' => $faker->numberBetween(50,999),
                 'ingatlan_szobak'=>$faker->numberBetween(0,7),
                 'ingatlan_garazs'=>$faker->numberBetween(0,2),
                 'ingatlan_leiras'=>$faker->text,
                 'ingatlan_ar'=>$ar,
                 'sorsjegy_ar'=>$faker->numberBetween(5000,10000),
                  'archived'=>true,

                 'ingatlan_kategoria' => 3



             ]);

         }

    }
}
