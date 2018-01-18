<?php
/**
 * Created by PhpStorm.
 * User: Strive
 * Date: 2017/10/19
 * Time: 22:28
 */
namespace  app\common\model;
use think\Model;

class News extends  Base
{

    public function getNews($data = [])
    {
        $data['status'] = ['neq', config('code.status_del')];
        $order = ['id' => 'desc'];

        $result = $this->where($data)
            ->order($order)
            ->paginate(1);

        return $result;
    }

    /**
     * 根据来获取列表数的数据
     * @param array $param
     */
    public function getNewsByCondition($condition = [], $from = 0, $size = 5)
    {
        if (!empty($condition['status'])) {
            $condition['status'] = [
                'neq', config('code.status_del')
            ];
        }

        $order = ['id' => 'desc'];
        $result = $this->where($condition)
            ->limit($from, $size)
            ->order($order)
            ->select();
        echo $this->getLastSql();
        return $result;
    }

    /**
     * 更具条件获取列表的数据总数
     */

    public function getNewsCountByCondition($condition = [])
    {
        if (!empty($condition['status'])) {
            $condition['status'] = [
                'neq', config('code.status_del')
            ];
        }
        $result = $this->where($condition)
            ->count();
        //  echo $this->getLastSql();
        return $result;
    }

    /**
     * @param int $Num
     * @return false|\PDOStatement|string|\think\Collection
     * 获取头部展示数据
     */
    public function getHeadData($Num = 4)
    {
        $data = [
            'is_head_figure' => 1,
            'status' => 1,
        ];
        $order = ['id' => 'desc'];
        $result = $this->where($data)
            ->field($this->_getListField())
            ->order($order)
            ->limit($Num)
            ->select();
        // echo $this->getLastSql();
        return $result;
    }

    public function getHeadPostitionList($Num = 20)
    {

        $data = [
            'is_position' => 1,
            'status' => 1,
        ];
        $order = ['id' => 'desc'];
        $result = $this->where($data)
            ->field($this->_getListField())
            ->order($order)
            ->limit($Num)
            ->select();
        echo $this->getLastSql();

        return $result;
    }


    /**
     * @return array
     *简化分类字段
     */
    private function _getListField()
    {
        return ['id', 'catid', 'title', 'image', 'read_count'];

    }
    /**
     * @param int $Num
     * @return false|\PDOStatement|string|\think\Collection
     * 点击数排行
     */
    public function getClickRank($data = 5)
    {

        $data = [
            'status' => 1,
        ];
        $order = ['read_count' => 'desc'];

        $result = $this->where($data)
            ->field($this->_getListField())
            ->order($order)
            ->select();
        // echo $this->getLastSql();
        return $result;
    }

}
