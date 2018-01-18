<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/21
 * Time: 18:49
 */
namespace app\common\lib;

class Time{

    public static function  get13TimeStamp(){

        list($a,$b) = explode(' ',microtime());

        return $b.ceil($a*1000);

    }

}
