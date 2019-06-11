<?php
/**
 * Created by PhpStorm.
 * User: Faon
 * Date: 2019/6/3
 * Time: 11:56
 */

class  IndexController extends BaseController{
    public  function  indexAction(){

    }

    public function  getTitleListAction(){
        $model=new AdminModel();
        $data=$model->getTitleList();
//        gf_dump($data);die;
        return  gf_ajax_success($data);
    }
}