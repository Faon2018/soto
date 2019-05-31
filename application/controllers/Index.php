<?php

class IndexController extends BaseController {
    // 默认Action
    public function indexAction() {
        //var_dump(111);die;
        $this->assign("content", "Hello World");

    }

    public function listAction() {
        $indexModel=new IndexModel();
        $data=$indexModel->getList();
        //var_dump($data);die;
        $this->assign("list",$data);
       $this->assign("test",'test');


    }
    public  function  infoAction(){
        $this->assign('info',phpinfo());
    }


}



