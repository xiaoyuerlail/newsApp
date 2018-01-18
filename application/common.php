<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function pagination($obj){

        if(!$obj){
            return '';
        }
    $params = request()->param();

        return '<div class="imooc-app">'.$obj->appends($params)->render().'</div>';

}

function cat($cat_id){
    if(!$cat_id){
        return '';
    }
        $cat_list = config('cat.list_cat');

    return !empty($cat_list[$cat_id]) ? $cat_list[$cat_id] : "";
}

function isYseNo($str){

    return $str ? '<span style="color:red">是</span>' : '<span >否</span>';

}

function show($status,$massage,$data=[],$Httpcode=200){

        $data = [
            'status'=>$status,
            'massage'=>$massage,
            'data'=>$data,
        ];

        return json($data,$Httpcode);

}

