<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require_once( __DIR__."/init.inc.php" );

use report\user\Auth;
use report\response\ReturnHandler;
use report\user\Session;

$g['menuId']='5d';
$obj=array();
$obj['account']='TW17050001';
SESSION::save($obj);
/*
 $parAry = array();
 if( isset($_GET['p1']) ){
 $tmpAry = explode ("/", isset($_GET['p1'])?$_GET['p1']:'');
 $parcount = 0;
 foreach( $tmpAry as $index => $value )
 {
 $value = trim($value);
 if( $value != null && $value != '' ){
 $parAry[$parcount] = $value;
 $parcount++;
 }
 }
 unset($index);
 unset($value);
 }
 
 if( empty($parAry[0]) ){
 $parAry[0] = 'index';
 }
 
 
 switch ($parAry[0]){
 case 'logout':
 Auth::logout();
 header("Location:".WEB_SITE_URL);
 exit();
 break;
 case 'ajax':
 if(!isset($parAry[1])){
 ReturnHandler::response(98);
 exit();
 }
 
 $ajaxPath = __DIR__."/ajax/";
 if(!is_file($ajaxPath.$parAry[1].".php")){
 ReturnHandler::response(98);
 exit();
 }
 
 require_once($ajaxPath.$parAry[1].".php" );
 exit();
 break;
 case 'favicon.ico':
 exit();
 break;
 default:
 $defaultPath = __DIR__."/view/";
 if(!is_file($defaultPath.$parAry[0].".php")){
 $parAry[1] = '頁面不存在';
 require_once($defaultPath."errorPage.php" );
 exit();
 }
 
 // if(in_array($parAry[0], $proxyFunList) && !Auth::isProxy()){
 //     $parAry[1] = '身份錯誤，無法操作';
 //     require_once($defaultPath."errorPage.php" );
 //     exit();
 // }
 
 //判斷是否需要登入
 if(in_array($parAry[0], $needLoginPage) && !Auth::isLogin()){
 $parAry[0] = 'login';
 //$parAry[0] = 'index';
 }
 
 require_once($defaultPath.$parAry[0].".php" );
 exit();
 break;
 }
 */
require_once(__DIR__."/view/index1.php" );
exit();
?>
