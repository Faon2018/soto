<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/22 0022
 * Time: 23:19
 */
class IndexModel extends DbModel{

    public function getList(){
        $sql="SELECT * FROM `ws_device_brand`";
      return  $this->getAll($sql);

    }

}