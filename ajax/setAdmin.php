<?php


use report\response\ReturnHandler;
use report\user\Auth;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

require_once( __DIR__."/../init.inc.php" );
$selAdminID = isset($selAdminID) ? $selAdminID : null;
$arr=array();
if (!is_null($selAdminID)){
    foreach ($selAdminID as $key => $value) {
        $arr[]=$value;
    }
}
$res=Auth::setAdminList($arr);
if ($res['code']!=0){
    ReturnHandler::response(32,null,'資料有錯誤');
}
else{
    ReturnHandler::response(1);
}