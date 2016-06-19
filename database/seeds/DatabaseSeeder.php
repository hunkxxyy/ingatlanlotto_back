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
        /*$this->call('userSeed');
        $this->call('oauth2Clients');
        $this->call('szintekSeed');
        $this->call('modulsSeed');
        $this->call('globalSeeds');
        $this->call('ingatlanDbSeed');*/
        $this->call('IngatlanKepekSeed');

    }
}
