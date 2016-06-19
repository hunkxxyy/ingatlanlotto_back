<?php

use Illuminate\Database\Seeder;

class modulsSeed extends Seeder
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
                'id'=>'3',
                'modultype'=>'termekek',
                'modulnev'=>'ingatlanok',
                'ertek1'=>'ingatlandb',
                'ertek2'=>'ingatlan_kepek',
                'ertek3'=>'ingatlan_kepek',
                'ertek4'=>'',
                'ertek5'=>'280->1480',
                'ertek6'=>'',

            ], [
                'id'=>'2',
                'modultype'=>'htmleditor',
                'modulnev'=>'fenti_menusor',
                'ertek1'=>'600',
                'ertek2'=>'650',
                'ertek3'=>'htmleditorkepek',
                'ertek4'=>'dinamikuskepek',
                'ertek5'=>'650',
                'ertek6'=>'admin/modulok/HTMLEDITOR/php/design/online.css',

            ], [
                'id'=>'1',
                'modultype'=>'htmleditor',
                'modulnev'=>'htmleditor',
                'ertek1'=>'300',

                'ertek2'=>'750',
                'ertek3'=>'htmleditorkepek',
                'ertek4'=>'hirekkepek',
                'ertek5'=>'828',
                'ertek6'=>'admin/modulok/HTMLEDITOR/php/design/online.css',
                'note'=>'vers:0.9 béta
a css file:php/php/moduls/htmleditor/design/online.css'


            ]
        ];

        foreach ($fields as $f)
        {
            DB::table('moduls')->insert($f);
        }

    }
}
