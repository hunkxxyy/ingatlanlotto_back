<?php

namespace App\utils;

use Illuminate\Database\Eloquent\Model;

class CommonFunction extends Model
{
   public static function  hungarianToEnglishConvert($string)
    {
        //Magyar ékezetes betűk
        $hungarianABC = [
            'á', 'é', 'í', 'ó', 'ö', 'ő', 'ú', 'ü', 'ű',
            'Á', 'É', 'Í', 'Ó', 'Ö', 'Ő', 'Ú', 'Ü', 'Ű',' '];
        //Angol ékezetes betűk
        $englishABC = [
            'a', 'e', 'i', 'o', 'o', 'o', 'u', 'u', 'u',
            'A', 'E', 'I', 'O', 'O', 'O', 'U', 'U', 'U','-'];


        return str_replace($hungarianABC, $englishABC, $string);
    }
}
