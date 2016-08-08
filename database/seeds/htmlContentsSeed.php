<?php

use Illuminate\Database\Seeder;

class htmlContentsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fields = ['kapcsolat_tartalom', 'kapcsolat_cim', 'regisztracio_mielott'];

        foreach ($fields as $f) {
            DB::table('html_cotents')->insert([
               'index' => $f
            ]);
        }

    }
}
