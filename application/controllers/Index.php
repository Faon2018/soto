<?php

class IndexController extends BaseController {



    // 默认Action
    public function indexAction() {
//        if (isset($_SESSION['admin']) && $_SESSION['admin']==true){
//
//        }else{
//            $this->getView()->disPlay('login/index.html');
//            exit;
//        }

        if (!$this->user){
            $this->getView()->disPlay('login/index.html');
            return  false;
        }

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


    public   function   loginAction(){

    }


}



