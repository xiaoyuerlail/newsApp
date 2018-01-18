<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/19
 * Time: 22:28
 */
namespace  app\common\model;
use think\Model;

class Version extends  Base
{
            public  function  getDaoxuVersion($dataType = ''){
                    $data = [
                        'status' => config('code.status_normal'),
                        'app_type' => $dataType,
                    ];

                    $order = ['id'=>'desc'];

                  return  $this->where($data)
                        ->order($order)
                        ->limit(1)
                        ->select();

                  echo  $this->getLastSql();
            }

}