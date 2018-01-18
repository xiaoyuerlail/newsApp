<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/21
 * Time: 13:51
 */
namespace app\common\lib\exception;
use think\Exception;
use Throwable;

class ApiException extends Exception{

        public $message = '';
        public $HttpCode = 500;
        public $code = 0;
        public  function  __construct($message = "",$HttpCode = 0, $code = 0)
        {
            $this->message = $message;
            $this->HttpCode = $HttpCode;
            $this->code = $code;

        }


}
