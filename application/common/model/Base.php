<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/19
 * Time: 22:25
 */

namespace  app\common\model;
use think\Model;

class Base extends  Model
{


    protected  $autoWriteTimestamp = true;
    public  function add($data){
        if(!is_array($data)){
            exception("传递数据不合法");
        }
        $this->allowField(true)->save($data);

        return $this->getLastInsID();
    }

}