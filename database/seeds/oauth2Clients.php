<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;
class oauth2Clients extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->truncate();
        $clients=[
            [
                'name'=>'hunk',
                'secret'=>'Editke76']
            ,[
                'name'=>'winner',
                'secret'=>'winner']

        ];

            $i=0;
        foreach ($clients as $c) {
            $i++;
            DB::table('oauth_clients')->insert([
                'id'=>$i,
               'secret'=>$c['secret'],
                'name'=>$c['name']
            ]);

        }



    }
}
