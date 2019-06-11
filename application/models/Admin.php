<?php
/**
 * Created by PhpStorm.
 * User: Faon
 * Date: 2019/6/4
 * Time: 15:06
 */

class  AdminModel  extends DbModel{
     public   $confName='soto';
     public   $table='title';

     public  function  getTitleList(){
         $sql="select id,`name`,url from {$this->table} where  is_del=0 ";
         return $this->getAll($sql);
     }
     public  function  insertTitle($data){
       return  $this->insert($this->table,$data);
     }

}