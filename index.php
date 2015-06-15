<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// change the following paths if necessary
define('PATH', dirname(__FILE__));
$yii=PATH.'/yii/framework/yii.php';
$config=PATH.'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
