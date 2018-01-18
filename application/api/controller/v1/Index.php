<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/23
 * Time: 11:24
 */
namespace app\api\controller\v1;
use app\api\controller\Common;
use app\common\lib\Aes;
use app\common\lib\exception\ApiException;

class Index extends Common{

    /**
     *
     * 获取首页head 推存数据
     *
     */
    public  function  index(){

        $head = model('News')->getHeadData();
        $head = $this->getDeilNews($head);
        $postitonList = model('News')->getHeadPostitionList();
        $postitonList = $this->getDeilNews($postitonList);

        return show(1,'ok',$head,200);
    }

    /**
     * 客户端初始化接口
     * 检测app是否升级
     */
    public  function  init(){
        $version = model('Version')->getDaoxuVersion($this->header['app_type']);

        if(empty($version)){
            throw new ApiException("error",404);
        }
        if($version['app_type'] > $this->header['app_type']){

        }
    }

}