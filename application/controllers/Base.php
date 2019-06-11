<?php
/**
 * Created by PhpStorm.
 * User: KF
 * Date: 2017/3/24
 * Time: 15:26
 */
class BaseController extends Yaf_Controller_Abstract
{
    protected $base_uri;

    public $conf;
    public $is_ajax;
    public $user;
    public $auth;
    public $isAdmin;
    public $param;
    public $admin;

//    public function init() {
//        // inti config
//        $conf = Yaf_Registry::get('config');
//        $this->conf = $conf;
//        $this->base_uri = $conf->application->baseUri;
//        $this->getView()->assign('BASE_URI', $this->base_uri);
//        $this->getView()->assign('username', 'faon');//测试用户
//        // init request mode
//        $this->is_ajax = $this->getRequest()->isXmlHttpRequest ();
//    }

    public function init() {
        // inti config
        $conf = Yaf_Registry::get('config');
        $this->conf = $conf;
        $this->base_uri = $conf->application->baseUri;
        $this->getView()->assign('BASE_URI', $this->base_uri);
        $this->getView()->assign('username', 'faon');//测试用户
        $this->is_ajax = $this->getRequest()->isXmlHttpRequest ();
//        session_start();
//        if (isset($_SESSION['admin']) && $_SESSION['admin']==true){
//
//        }else{
//            $_SESSION['admin']=true;
//            $this->getView()->disPlay('login/index.html');
//            exit;
//        }
        $this->getView()->disPlay('login/index.html');
            exit;
//        if ($this->admin){
//
//
//        }else{
//            $this->admin=true;
//            $this->getView()->disPlay('login/index.html');
//            exit;
//        }


        // init request mode

    }

    /**
     * 重写render方法，自动根据模块加载模板
     */
    protected function render($action, array $parameters = null){
        $template_name = str_ireplace('Controller', '', get_class($this)).'/'.$action;
        // echo $this->getRequest()->module;
        $module = strtolower($this->getRequest()->module);
        // echo $this->conf->application->dispatcher->defaultModule;
        if ($module != $this->conf->application->dispatcher->defaultModule) {
            $template_name = $module.'/'.$template_name;
        }
        $template_name = strtolower($template_name.'.'.$this->conf->application->view->ext);
        return $this->getView()->render($template_name, $parameters);
    }

    protected function getParam($key, $default='') {
        $s = $this->getRequest()->getParam($key);
        if (empty($s)) {
            $s = isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default;
        }
        return gf_safe_input($s);
    }

    protected function getQuery($key, $default='') {
        $s = isset($_GET[$key]) ? $_GET[$key] : $default;
        return gf_safe_input($s);
    }

    protected function getPost($key, $default='') {
        $s = isset($_POST[$key]) ? $_POST[$key] : $default;
        return gf_safe_input($s);
    }

    public function assign($key, $var) {
        $this->getView()->assign($key, $var);
    }


}