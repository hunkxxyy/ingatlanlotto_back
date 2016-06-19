<?php

use Illuminate\Database\Seeder;

class szintekSeed extends Seeder
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
                'parent'=>'0',
                'nev'=>'MODULOK',
                'tipus'=>'modulok',
                'pos'=>'0'
            ],
            [
                'parent'=>'0',
                'nev'=>'Felső menü',
                'link'=>'2',
                'tipus'=>'2',
                'pos'=>'1'
            ],
            [
                'parent'=>'0',
                'nev'=>'Ingatlanok',
                'link'=>'ingatlanok',
                'termekMeret'=>'120,400,1000****',
                'tipus'=>'3',
                'pos'=>'2'
            ]
            ,
            [
                'parent'=>'2',
                'nev'=>'Bemutatkozas',
                'link'=>'bemutatkozas',
                'tipus'=>'3',
                'pos'=>'2'
            ]
            ,
            [
                'parent'=>'2',
                'nev'=>'Eredmény hírdetés',
                'link'=>'eredmeny-hirdetes',
                'tipus'=>'3',
                'pos'=>'2'
            ]
            ,
            [
                'parent'=>'2',
                'nev'=>'Híreink',
                'link'=>'hireink',
                'tipus'=>'3',
                'pos'=>'2'
            ]
            ,
            [
                'parent'=>'2',
                'nev'=>'Játékszabály',
                'link'=>'jatekszabaly',
                'tipus'=>'3',
                'pos'=>'2'
            ]
            ,
            [
                'parent'=>'2',
                'nev'=>'Kapcsolat',
                'link'=>'kapcsolat',
                'tipus'=>'3',
                'pos'=>'2'
            ]
            ,
            [
                'parent'=>'6',
                'nev'=>'Friss hírek',
                'link'=>'friss-hirek',
                'tipus'=>'3',
                'pos'=>'2'
            ]
            ,
            [
                'parent'=>'6',
                'nev'=>'Arhívum',
                'link'=>'archivum',
                'tipus'=>'3',
                'pos'=>'2'
            ]
            ,
            [
                'parent'=>'2',
                'nev'=>'Admin',
                'link'=>'admin',
                'tipus'=>'3',
                'pos'=>'20'
            ]
            ,
            [
                'parent'=>'11',
                'nev'=>'Ingatlanok',
                'link'=>'admin/ingatlanok',
                'tipus'=>'3',
                'pos'=>'1'
            ] ,
            [
                'parent'=>'11',
                'nev'=>'Felhasználók',
                'link'=>'admin/users',
                'tipus'=>'3',
                'pos'=>'1'
            ]
        ];

        foreach ($fields as $f)
        {
            DB::table('szintek')->insert($f);
        }

    }
}
