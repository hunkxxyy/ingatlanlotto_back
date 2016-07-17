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
      //DB::statement("TRUNCATE TABLE users ");
      DB::table('users')->delete();
        DB::statement("TRUNCATE TABLE oauth_clients  ");
        DB::statement("TRUNCATE TABLE moduls  ");
        DB::statement("TRUNCATE TABLE news");
        DB::statement("TRUNCATE TABLE eredmenyek");
        DB::statement("TRUNCATE TABLE szintek  ");

        /*     DB::statement("TRUNCATE TABLE ingatlandb  ");
          DB::statement("TRUNCATE TABLE ingatlan_kepek  ");


            DB::statement("TRUNCATE TABLE szintek ");

            DB::statement("TRUNCATE TABLE global_values ");

            DB::statement("TRUNCATE TABLE oauth_clients  ");*/

        $this->call('userSeed');
        $this->call('oauth2Clients');
        $this->call('szintekSeed');
        $this->call('modulsSeed');
        $this->call('globalSeeds');
      /*élesbe szerkesztés alatt*/ // $this->call('ingatlanDbSeed');
        $this->call('NewsSeed');
        $this->call('EredmenyeSeed');
       // $this->call('IngatlanKepekSeed');


/*
        DB::statement("TRUNCATE TABLE ingatlandb  ");
        $this->call('ingatlanDbSeed');*/
    }
}
