<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class IngatlanKepekSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingatlan_kepek')->truncate();
        $faker = Faker::create();

        /*for ($i=1 ;$i<50 ;$i++)
        {
            for($m=1;$m<rand(2,9);$m++)
            {
                DB::table('ingatlan_kepek')->insert([

                    'ingatlan_id' => $i,
                    'name' => $faker->word,
                    'pos' => $i,
                    'file' => $faker->imageUrl(400,300)



                ]);

            }

        }*/

    }
}
