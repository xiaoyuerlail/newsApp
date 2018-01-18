<?php
namespace app\admin\controller;

use think\Controller;

class Admin extends Base
{
    public function add()
    {
        //判断是否是post提交
            if(request()->isPost()){
       $data = input('post.');
       //validate
                $validate =  Validate('AdminUser');

            $result = $validate->check($data);
          if (!$result){
            $this->error($validate->getError());
          }


          try{
                $id = model('AdminUser')->add($data);
              }catch(\Exception $e){
            $this->error($e->getMessage());
             }
            if($id){
                  $this->success('id='.$id."新用户新增成功");
            }else{
                $this->error("新增用户失败");
            }

        }else{

            return   $this->fetch();

           }


    }

}
