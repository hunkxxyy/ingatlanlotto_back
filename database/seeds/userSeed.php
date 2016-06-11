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
        $faker=Faker::create();
        User::truncate();
        User::create([

            'name'=>'hunk',
            'email'=>'hunk74@gmail.com',
            'privilegium'=>'ADMIN',
            'password'=> \Illuminate\Support\Facades\Hash::make("editke76"),
            'old_password'=> "editke76"
        ]);

    }
}
