<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/17
 * Time: 22:35
 */
namespace app\admin\controller;
use think\Controller;

class Base extends Controller{

    public $page = '';

    /**
     * @var string
     * 每页显示多少条
     */
    public $size = '';

    /**
     * 查询条件的起始值
     */

    public $from = 0;

        public function _initialize(){
            $isLogin = $this->isLogin();
            if(!$isLogin){
               $this->redirect('login/index');
            }
        }

    public function  isLogin(){

            $is_data=session(config('admin.session_user'),'',config('admin.session_scope'));
            if($is_data){
                return true;
            }else{
                return false;
            }

    }

    /**
     * 获取分页内容 page size 内容
     */

    public function getPageAndSize($data){

        $this->page = !empty($data['page']) ? $data['page'] : "1";
        $this->size = !empty($data['size']) ? $data['size'] : config('paginate.list_rows');
        $this->from = ($this->page-1) * $this->size;
    }


}