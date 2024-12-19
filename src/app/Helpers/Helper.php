<?php

namespace App\Helpers;

class Helper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public static function first_name(string $string)
    {
        $nameUsr = explode(" ", $string);
        return $nameUsr[0];
    }

    public static function short_name(string $string)
    {
        $nameUsr = explode(" ", $string);
        if(count($nameUsr) == 1) {
            $nomeUsrL = $nameUsr[0];
        } else {
            $nomeUsrL = $nameUsr[0]." ".$nameUsr[count($nameUsr)-1];
        }

        return $nomeUsrL;
    }


    // public static function uuuiToPath(string $typeDoc, string $uuid) {

    //     return strtolower($typeDoc).'/'.substr($uuid,0,2).'/'.substr($uuid,2,2).'/'.substr($uuid,4,2).'/'.substr($uuid,6,2).'/';

    // }

}
