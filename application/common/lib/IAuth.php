<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/17
 * Time: 19:45
 */

namespace  app\common\lib;
use app\common\lib\Aes;
use think\Cache;
class IAuth {

    public static function setPassword($pwd){

        return md5($pwd.config('app.pwd_jm'));

    }

    public static function setSign($data=[]){
        //按字段排序
        ksort($data);
        //拼接字符串
       $string = http_build_query($data);
       //加密字符串
        $string = (new Aes())->encrypt($string);


        return $string;

    }

    public static function checkSignpass($data){

        $jm = (new Aes())->decrypt($data['sign']);

        if (empty($jm)){
        return false;
        }
        parse_str($jm,$arr);
      //  dump($arr);
        if(!is_array($arr) || empty($data['did']) || $arr['did'] != $data['did']){

            return false;
        }
        if(config('app_debug') == true){

        //sign时间时效性
        if((time() - ceil($arr['time'] / 1000)) >config('app.app_sign_time')){
            return false;
        }
        //sign唯一性
        if(Cache::get($data['sign'])){
            return false;
        }
        }

        return true;




    }

}