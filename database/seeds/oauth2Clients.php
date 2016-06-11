<?php

use Illuminate\Database\Seeder;

class oauth2Clients extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //  DB::table('oauth_clients')->truncate();
        DB::table('oauth_clients')->insert([
            'id'=>'1',
            'secret'=>'hunk',
            'name'=>'hunk74@gmail.com'
        ]);



    }
}
