<?php

/**
 *
 * @Author: Carl
 * @Since: 2018-03-30 18:17
 * Created by PhpStorm.
 */
class LoginController extends BaseController {

    protected $isauth = FALSE;

    public function indexAction() {

    }

    public function doLoginAction() {

        $user = $this->getPost('username');
        $password = $this->getPost('password');
        gf_dump($user);
        gf_dump($password);
//        session_start();
//        $_SESSION['admin']
//        gf_dump($password);die;

            $this->getView()->disPlay('index/index.html');
//            $this->forward('index');
            exit;


//        if ((new UserModel())->getUserInfo($user)) {
//            $_SESSION['user'] = $user;
//            $this->redirect('');
//        } else {
//            $this->forward('index');
//        }

    }
}