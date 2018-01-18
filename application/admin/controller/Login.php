<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/17
 * Time: 9:15
 */

namespace app\admin\controller;

use app\common\model\AdminUser;
use think\Controller;
use think\Validate;
use app\common\lib\IAuth;

class Login extends Base
{
    public function _initialize()
    {

    }

    public function index()
    {
        $is_login = $this->isLogin();
        if($is_login){
            $this->redirect('index/index');

        }else{
            return  $this->fetch();
        }


    }
    public function check(){

        if(request()->isPost()){

        $data = input('post.');

            $validate =  Validate('Login');
            $result = $validate->check($data);
            if(!$result){
                $this->error($validate->getError());
            }


        if(!captcha_check($data['code']))
        {
            $this->error("验证码错误1");
        }

            try {
                $user = model('AdminUser')->get(['username' => $data['username']]);
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }
        if(!$user || $user->status != config('code.status_normal')){
            $this->error('没有这个用户');
        }
        if(IAuth::setPassword($data['password']) != $user['password']){
            $this->error("密码不正确");
        }
        //登录用户  记录状态

            $udata = [
                "last_login_time" => time(),
                "last_login_ip" =>request()->ip(),

            ];

        try{
            model('AdminUser')->save($udata,['id'=>$user->id]);
        }catch(\Exception $e){
            $this->error($e->getMessage());
        }


        session(config("admin.session_user"),$user,config("admin.session_scope"));

        $this->success("登录成功","index/index");


        }else{

            $this->error("非法提交");
        }



    }
        public function Logout(){
        session(null,config('admin.session_scope'));
        $this->redirect('/  login/index');
        }


}


