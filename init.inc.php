<?php
use report\user\Session;
if (function_exists ( 'date_default_timezone_set' )){
    date_default_timezone_set('Asia/Taipei'); //PHP5設定時區, 在PHP4無法使用
} else {
    putenv("TZ=Asia/Taipei"); //PHP4設定時區的用法
}
header ('Content-type: text/html; charset=utf-8');
ini_set('display_errors', 'On');
error_reporting( E_ALL | ~E_WARNING | ~E_NOTICE );

//class 檔案目錄
$classDirectoryAry = array();
$classDirectoryAry[] = '';
$classDirectoryAry[] = 'api/';
$classDirectoryAry[] = 'base/';
$classDirectoryAry[] = 'response/';
$classDirectoryAry[] = 'user/';
$classDirectoryAry[] = 'system/';
$classDirectoryAry[] = 'organization/';
$classDirectoryAry[] = 'tool/';
$classDirectoryAry[] = 'core/';
$classDirectoryAry[] = 'core/order/';
$classDirectoryAry[] = 'core/organization/';
$classDirectoryAry[] = 'core/system/';
function __autoload($class){
    global $classDirectoryAry;
    
    $classNameAry = explode("\\",$class);
    $class = $classNameAry[count($classNameAry)-1];
    
    $isExists = false;
    foreach( $classDirectoryAry as $directoryPath )
    {
        if( file_exists(__DIR__.'/class/'.$directoryPath.$class.'.cls.php') ){
            require_once(__DIR__.'/class/'.$directoryPath.$class.'.cls.php');
            $isExists = true;
            break;
        }else if( file_exists(__DIR__.'/class/'.$directoryPath.$class.'.if.php') ){
            require_once(__DIR__.'/class/'.$directoryPath.$class.'.if.php');
            $isExists = true;
            break;
        }
    }
    unset($directoryPath);
    if( !$isExists )
        throw new Exception("找不到 {$class} 這個物件檔案，無法載入！");
        
}

session_start();
if (!Session::get('login')){
    $session = array('login'=>false);
    Session::save($session);
}

//glboal array parameter
$g = array();

//parameter init
foreach($_GET as $var => $value){
    $g[$var] = $value;
    $$var = $value;
}

foreach ($_POST as $var => $value){
    $g[$var] = $value;
    $$var = $value;
}
require_once(__DIR__.'/config/config.inc.php');

require_once(__DIR__.'/config/serverConfig.cnf.php');

require_once(__DIR__.'/config/initMysql.inc.php');
?>
