<?php
/**
 * Created by PhpStorm.
 * User: Faon
 * Date: 2019/6/3
 * Time: 11:56
 */

class  TitleController extends BaseController{
    public  function  indexAction(){
//        //连接本地的 Redis 服务
//        $redis = new Redis();
//        $redis->connect('127.0.0.1', 6379);
//        echo "Connection to server successfully";
//        //设置 redis 字符串数据
//        $redis->set("tutorial-name", "Redis tutorial");
//        // 获取存储的数据并输出
//        echo "Stored string in redis:: " . $redis->get("tutorial-name");
//        return  false;
    }
    public  function  getListAction(){
        return  gf_ajax_success([['name'=>'123','value'=>'456'],['name'=>'234','value'=>'567']]);
    }

    public  function  addNewAction(){
        $title=$this->getParam('title','');
        $level=$this->getParam('level',0);
        $url=$this->getParam('url','');
        $parent=0;
        if ($level){
            $parent=$this->getParam('parent');
        }
        $data=[
            'name'=>$title,
            'level'=>$level,
            'parent'=>$parent,
            'url'=>$url
        ];

        $result=(new AdminModel())->insertTitle($data);
        if ($result){
            return  gf_ajax_success('添加成功！');
        }
        return  gf_ajax_error('添加失败！');
    }

}