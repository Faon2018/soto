<?php
/**
 * Created by PhpStorm.
 * User: Faon
 * Date: 2019/6/3
 * Time: 11:56
 */

class  TitleController extends BaseController{
    public  function  indexAction(){

    }
    public  function  getListAction(){
        return  gf_ajax_success([['name'=>'123','value'=>'456'],['name'=>'234','value'=>'567']]);
    }

    public  function  addNewAction(){

    }

}