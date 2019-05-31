<?php
/**
 * Created by PhpStorm.
 * User: Faon
 * Date: 2019/5/23
 * Time: 11:19
 */

class SqlRunTimeModel  extends  DbModel
{
    public  $table='test';
    public $confName = 'test';


    public  function  getResult($db='',$sql){
        if ($db!=''){
            $this->confName=$db;
        }
        $data=0;
//        if (count($data))
        $start_time=microtime(true);
        $result=$this->getAll($sql);
        $end_time=microtime(true);
//        gf_dump(DbEXClass::getError());die;
       if (DbEXClass::getError()==null && DbEXClass::getError()==''){
           $data=$end_time-$start_time;
       }
        return  $data;
    }

}