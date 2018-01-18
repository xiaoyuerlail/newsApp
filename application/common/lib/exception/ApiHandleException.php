<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/21
 * Time: 12:00
 */

namespace app\common\lib\exception;
use think\exception\Handle;

class ApiHandleException extends Handle{
    public $HttpCode = 500;
    public function render(\Exception $e){
        if(config('app_debug') == true){

            return parent::render($e);
         }
        if ($e instanceof ApiException) {
            $this->HttpCode = $e->HttpCode;
        }


        return show(0,$e->getMessage(),[],$this->HttpCode);

    }

}