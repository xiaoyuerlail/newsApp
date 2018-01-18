<?php
namespace app\admin\controller;

use think\Controller;

class Index extends Base
{

    public function index()
    {
        //halt(session(config('admin.session_user'),'',config('admin.session_scope')));

       return  $this->fetch();
    }

    public function welcome(){

        return  "控制中心";
    }
    public function admin(){

        return  "控制中心";
    }
}
