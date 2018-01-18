<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/16
 * Time: 16:49
 */
namespace  app\common\validate;
use think\Validate;

class AdminUser extends  Validate{

    protected  $rule = [
        'username' => 'require|max:20',
        'password' => 'require|max:20',
    ];
    protected $message = [
    'username.require' => '用户名不能为空',

    ];
}
