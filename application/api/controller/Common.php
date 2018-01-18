<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/21
 * Time: 14:53
 */

namespace app\api\controller;
use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Aes;
use app\common\lib\IAuth;
use app\common\lib\Time;
use think\Cache;
use think\Model;

class Common extends Controller
{

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
    /**
     * @var string
     * 存储解密sign
     */
    public $header = '';

    /**
     * 初始化方法
     */
    public function  _initialize()
    {
        $this->chackRequestAuth();
        //$this->testAes();
    }

    /**
     * 检查app秦秋数据是否合法
     */
        public function chackRequestAuth(){
            $head = $this->request->header();
            //halt($head);
            if(empty($head['sign']))
            {
                throw new ApiException("sign不存在",400);
            }
            if(!in_array($head['app_type'],config('app.apptypes')))
            {
                throw new ApiException("类型不存在",400);
            }

           if(!IAuth::checkSignpass($head)){

               throw new ApiException("授权码sign失败",401);
           }

           $this->header = $head;

           Cache::set($head['sign'],1,config('app.app_cache_sign_time'));

        }

        public function testAes(){
            $data = [
                'did' => 'zxcvbnm',
                'version' =>1,
                'time' =>Time::get13TimeStamp(),

            ];
           halt($data);
            echo IAuth::setSign($data);
          $ur = 'sign=qwertyuiop&version=1&app_type=android&did=zxcvbnm&model=iphone6';
           // echo (new Aes())->encrypt($ur);
        }

    public  function getDeilNews($news = []){
        if (empty($news)){
            return [];
        }
        $cats = config('cat.list_cat');
        foreach ($news as $key=>$value){

        $news[$key]['catname'] = $cats[$value['catid']] ? $cats[$value['catid']] : '-';
        }
        return $news;
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