<?php
/**
 * Created by PhpStorm.
 * User: Faon
 * Date: 2019/5/23
 * Time: 11:17
 */

class SqlRunTimeController extends  BaseController
{

    public  function  indexAction(){

    }
    public  function  testAction(){

    }


    public   function   getResultAction(){
        $data=$this->getPost('data','');
        if ($data==''){
            return  gf_ajax_error('获取数据失败');
        }
        $data=json_decode($data,true);
        $sqlModel=new SqlRunTimeModel();
        $result_time=[];
        $legend=[];
//        gf_dump($data);die;
        if (!ini_get('safe_mode')){
            set_time_limit(200);
            foreach ($data as $key=>$db_sql){
                $legend[$db_sql['db'].'_'.$key]=$db_sql['sql'];
                $i=0;
                while ($i<10){
                    $result_time[$db_sql['db'].'_'.$key][]=round($sqlModel->getResult($db_sql['db'],$db_sql['sql']),4)*10000;
                    $i++;
                }
    //            array_push($result_time,$sqlModel->getResult($db_sql['db'],$db_sql['sql']));

            }
        }
        return  gf_ajax_success(['data'=>$result_time,'legend'=>$legend]);
    }

}