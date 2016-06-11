<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User as User;

class userSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        User::truncate();
        User::create([

            'name' => 'hunk',
            'email' => 'hunk74@gmail.com',
            'privilegium' => 'ADMIN',
            'password' => \Illuminate\Support\Facades\Hash::make("editke76"),
            'old_password' => "editke76"
        ]);
        User::create([

            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'privilegium' => 'ADMIN',
            'password' => \Illuminate\Support\Facades\Hash::make("winnerPassword2016"),
            'old_password' => "winnerPassword2016"
        ]);
        for ($i = 0; $i < 20; $i++) {

            User::create([
                'name' => $faker->userName,
                'email' => $faker->email,
                'privilegium' => 'USER',
                'password' => \Illuminate\Support\Facades\Hash::make('123456'),
                'cim_irsz' => $faker->postcode,
                'cim_varos' => $faker->city,
                'cim_cim' => $faker->address,
                'cim_telefon' => $faker->phoneNumber

            ]);
        }
    }
}
