<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\IngatlanKepek;
use Illuminate\Contracts\Filesystem\Filesystem;
class IngatlanKepekSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingatlan_kepek')->truncate();
        $faker = Faker::create();
        $piccCount=0;
        for ($i=1 ;$i<30 ;$i++)
        {
            $pos=0;
            for($m=1;$m<5;$m++)
            {

                $pos++;
                $piccCount++;
                $this->createPaths($piccCount);
                $file=$piccCount.'.jpg';
                copy('ingatlankepek/tmpkepek/'.$piccCount.'.jpg', 'ingatlankepek/'.$piccCount.'/kozepes/'.$file);
                DB::table('ingatlan_kepek')->insert([

                    'ingatlan_id' => $i,
                    'name' => $faker->word,
                    'pos' => $pos,
                    'file' => $file



                ]);


            }

        }

    }
    private function createPaths($picId)
    {
        $mainDir = 'ingatlankepek/' . $picId;

        foreach (IngatlanKepek::$kepmeretek as $meret) {
            $dir= $mainDir . '/' . $meret['nev'];

            File::makeDirectory($dir, 0777,true,true);
            chmod($dir, 0777);

        }
        return  $mainDir;


    }
}
