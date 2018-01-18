<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/18
 * Time: 14:41
 */
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\lib\Upload;
class Image extends Base{

    public function upload0(){

       $file = request::instance()->file("file");
       $info= $file->move('Upload');
        if($info && $info->getPathname()){
            $data = [

                'status' => 1,
                'message' => 'ok',
                'data' =>"/".$info->getPathname(),

            ];
            echo json_encode($data);exit;
        }


        echo json_encode(['status'=>0,'message'=>'上传失败']);
    }

    /**
     * 牛七云
     */
    public function upload(){
       $img_u=Upload::image();
       if($img_u){
           $data = [

               'status' => 1,
               'message' => 'ok',
               'data' =>config('qiniu.image_url').$img_u,

           ];
           echo json_encode($data);exit;
       }else{
           echo json_encode(['status'=>0,'message'=>'error']);
       }



    }

}