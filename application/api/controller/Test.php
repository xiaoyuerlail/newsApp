<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/21
 * Time: 10:03
 */
namespace app\api\controller;

use app\common\lib\exception\ApiException;
use think\Controller;
use think\Exception;
use app\common\lib\Aes;

class Test extends Common{

    public function index(){

        return ['count'=>1,'name'=>'小米'];
    }
    public  function  update($id=0){

        $id = input('put.');

        return $id;
    }
    public function save(){
        $data = input('post.');

    /*   if($data['m'] !=1){
          throw new ApiException('你提交的数据不合法哦',401);
       }*/


           $post_info= input('post.');

           return show(1,'ok',(new Aes())->encrypt(json_encode($post_info)),201);
    }
}