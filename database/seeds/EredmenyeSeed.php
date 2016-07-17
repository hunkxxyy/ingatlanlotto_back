<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class EredmenyeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=1 ;$i<6 ;$i++)
        {

            DB::table('eredmenyek')->insert([

                'title' => $faker->title,
                'content'=>$faker->text,
                'datum'=>$faker->dateTime,



            ]);

        }
    }

}
