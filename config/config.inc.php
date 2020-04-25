<?php
$defaultMenuID='1';
$hostData = $_SERVER['HTTP_HOST'];
//define('WEB_SITE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/Kagana/');
//define('WEB_SITE_URL', 'https://'.$_SERVER['HTTP_HOST'].'/');
define('WEB_SITE_URL', 'https://'.$hostData.'/');
define('WEB_ASSET_URL', WEB_SITE_URL.'assets/');  
//資源版本
define('WEB_ASSET_VERSION', '20180124');
define('DBName', 'fbi');
require_once(__DIR__.'/needLoginPage.inc.php');
