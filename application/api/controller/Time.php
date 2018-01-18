<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/21
 * Time: 10:03
 */
namespace app\api\controller;

use app\common\lib\exception\ApiException;
use app\common\model\Base;
use think\Controller;
use think\Exception;
use app\common\lib\Aes;

class Time extends Base {

    public function index(){


        return show(1,'ok',time());
    }

}