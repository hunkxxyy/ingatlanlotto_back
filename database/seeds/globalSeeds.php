<?php

use Illuminate\Database\Seeder;

class globalSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fields=[
            [
                'field'=>'index',
                'value'=>'nincs beállítva',
            ]
        ];
        DB::table('global_values')->truncate();
        foreach ($fields as $f)
        {
            DB::table('global_values')->insert($f);
        }

    }
}
