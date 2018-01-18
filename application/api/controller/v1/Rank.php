<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/27
 * Time: 14:13
 */
namespace app\api\controller\v1;
use app\api\controller\Common;
use app\common\lib\Aes;
use app\common\lib\exception\ApiException;

class Rank extends Common
{
      public function index(){
          try{
              $rank = model('News')->getClickRank();
              $rank = $this->getDeilNews($rank);
          } catch(\Exception $e){
              return new ApiException('Err','400');
          }
            return  show(1,'ok',$rank);
      }
}
