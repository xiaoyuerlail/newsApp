<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/26
 * Time: 10:41
 */

namespace app\api\controller\v1;
use app\api\controller\Common;
use app\common\lib\Aes;
use app\common\lib\exception\ApiException;

class News extends Common{
    /**
     * 获取列表数据 10条
     */
        public function index(){
            $data=input('get.');

            if(!empty($data['title'])){

                $data['title'] = ['LIKE','%'.$data['title'].'%'];
            }
            $data['status'] = config('code.status_normal');
            if(!empty($data['catid'])) {
                $data['catid'] = input('get.catid', 0, 'intval');
            }



            //halt(input('get.'));
            $this->getPageAndSize($data);
          //dump(input('get.'));
            $total = model('News')->getNewsCountByCondition($data);
            $news = model('News')->getNewsByCondition($data,$this->size,$this->from);
           // halt($this->getDeilNews($news));
                $result = [
                    'total' => $total,
                    'page_num' =>ceil($total/$this->size),
                    'list' => $this->getDeilNews($news),
                ];
              //  halt($result);
            return show(1,'ok',$result,200);
        }


}