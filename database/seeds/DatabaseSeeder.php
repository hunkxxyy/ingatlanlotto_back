<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /* DB::statement("TRUNCATE TABLE users ");
         DB::statement("TRUNCATE TABLE ingatlandb  ");
        DB::statement("TRUNCATE TABLE ingatlan_kepek  ");
        DB::statement("TRUNCATE TABLE moduls  ");

          DB::statement("TRUNCATE TABLE szintek ");
          DB::statement("TRUNCATE TABLE oauth_clients  ");
          DB::statement("TRUNCATE TABLE global_values ");

          DB::statement("TRUNCATE TABLE oauth_clients  ");*/

        $this->call('userSeed');
        $this->call('oauth2Clients');
        $this->call('szintekSeed');
        $this->call('modulsSeed');
        $this->call('globalSeeds');
        $this->call('ingatlanDbSeed');
       // $this->call('IngatlanKepekSeed');


/*
        DB::statement("TRUNCATE TABLE ingatlandb  ");
        $this->call('ingatlanDbSeed');*/
    }
}
