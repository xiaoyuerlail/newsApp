<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/18
 * Time: 14:10
 */

namespace  app\admin\controller;

use think\Controller;


class News extends Base{

    public function index(){

        $whereData = [];

        $data = input('param.');
        $query = http_build_query($data);
//dump($query);
        //搜索开始
        if(!empty($data['start_time']) && !empty($data['end_time']) && $data['end_time'] > $data['start_time']){
            $whereData['create_time'] = [
                ['gt',strtotime($data['start_time'])],
                ['lt',strtotime($data['end_time'])],
            ];
        }
        if (!empty($data['catid'])){
            $whereData['catid'] = intval($data['catid']);
        }
        if (!empty($data['title'])){
            $whereData['title'] = ['like','%'.$data['title'].'%'];
        }

      // dump($data);
      // $News= model('News')->getNews();

       //模式二
        //page size  from

        $this->getPageAndSize($data);


        $News = model('News')->getNewsByCondition($whereData,$this->from, $this->size);
        $total = model('News')->getNewsCountByCondition($whereData);

        //结合总数+size = 多少页
            $pageTotal = ceil($total / $this->size);
           // halt($pageTotal);

            return $this->fetch('',[
                'news_list'=>$News,
                'pageTotal' =>$pageTotal,
                'index_page' => $this->page,
                'cat_list' => config('cat.list_cat'),
                'cat_id'=>empty($data['catid']) ? '' : $data['catid'],
                'start_time'=>empty($data['start_time']) ? '' : $data['start_time'],
                'end_time'=>empty($data['end_time']) ? '' : $data['end_time'],
                'title'=>empty($data['title']) ? '' : $data['title'],
                'query'=>$query,
                ]);

    }

    public function add(){


         if(request()->isPost()){

          $data=input('post.');
          try{
            $id = model('News')->add($data);
          }catch(\Exception $e){
             return  $this->result('',0,'新增失败','json');
          }

            if($id){

           return $this->result(['jump_url'=>url('news/index')],"1",'新增成功','json');

            }else{
                return $this->result('',0,'新增失败','json');
            }

        }else{
            return $this->fetch('',
                 ['list_cat'=>config('cat.list_cat')]
            );
        }

    }

}