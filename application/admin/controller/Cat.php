<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/23
 * Time: 8:58
 */
namespace app\admin\controller;

use think\Controller;

class Cat extends Controller{

    public function  getCat(){
        $result[] =[
            'catid'=>0,
            'catname'=>'首页',
        ];
        $catList = config('cat.list_cat');

        foreach($catList as $k => $v){
                $result[] = [
                    'catid'=>$k,
                    'catname'=>$v,
                      ];
        }
      return show('1','ok',$result,200);
    }


}