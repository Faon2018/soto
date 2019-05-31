<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/8 0008
 * Time: 15:17
 */

class Bootstrap extends Yaf_Bootstrap_Abstract {
    public function _initConfig() {
        // 把配置保存起来
        $arrConfig = Yaf_Application::app()->getConfig();
        Yaf_Registry::set('config', $arrConfig);
    }
    public function _initFunction(Yaf_Dispatcher $dispatcher) {
        Yaf_Loader::import( "Function.php");
    }
    public function _initSmarty(Yaf_Dispatcher $dispatcher) {
        $smarty = new Smarty_Adapter(null, Yaf_Application::app()->getConfig()->smarty);
        Yaf_Dispatcher::getInstance()->setView($smarty);
    }

//   public function _initSession() {
//       if (!session_id()) {
//            Yaf_Session::getInstance()->start();
//       }
//		header('content-type:text/html;charset=utf-8');
//   }
//
//   public function _initPlugin(Yaf_Dispatcher $dispatcher) {
//        //注册一个插件
//       $objSamplePlugin = new SamplePlugin();
//        $dispatcher->registerPlugin($objSamplePlugin);
//    }
//
//	public function _initRoute(Yaf_Dispatcher $dispatcher) {
//		//var_dump(); //在路由结束以后, 获取起作用的路由协议
//		//var_dump(getRoute());
//		//var_dump(getRoutes());
//		//在这里注册自己的路由协议,默认使用简单路由
//		//$router = Yaf_Dispatcher::getInstance()->getRouter();
//		/**
//		 * 添加配置中的路由
//		 */
//		//$router->addConfig(array());
//	}
//
//	public function _initView(Yaf_Dispatcher $dispatcher){
//		//在这里注册自己的view控制器，例如smarty,firekylin
//	}
//

}
