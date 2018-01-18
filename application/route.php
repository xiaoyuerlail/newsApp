<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

Route::get('test','api/test/index');
Route::put('test/:id','api/test/update');
Route::post('test','api/test/save');

Route::get('api/:ver/cat','api/:ver.cat/getCat');
Route::get('api/:ver/index','api/:ver.index/index');
Route::resource('api/:ver/news','api/:ver.news');
//排行路由
Route::resource('api/:ver/rank','api/:ver.rank');
//初始化接口
Route::get('api/:ver/init','api/:ver.index/init');