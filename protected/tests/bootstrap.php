<?php
define('PATH', dirname(__FILE__));
// change the following paths if necessary
$yiit=PATH.'/../../yii/framework/yiit.php';
$config=PATH.'/../config/test.php';

require_once($yiit);
require_once(dirname(__FILE__).'/WebTestCase.php');

Yii::createWebApplication($config);
