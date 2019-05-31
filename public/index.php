<?php
define("APP_PATH",  dirname(__FILE__) . '/../');
define("YAF", 1);
define('WS_EXCEPTION', 10000);
$app =new Yaf_Application(APP_PATH . "/conf/application.ini");
$app->bootstrap()->run();
?>