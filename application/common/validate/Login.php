<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/17
 * Time: 10:31
 */

namespace  app\common\validate;
use think\Validate;

class Login extends  Validate
{

    protected $rule = [
        'username' => 'require|max:15',
        'password' => 'require|max:15',
        'code' => 'require|max:5',

    ];
    protected $message = [
        'username.require' => '用户名不能为空',
        'password.require' => '密码不能为空',
        'code.require' => '验证码不能为空',
    ];


}