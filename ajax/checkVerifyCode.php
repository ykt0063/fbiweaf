<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

require_once( __DIR__."/../init.inc.php" );

use report\user\Auth;
use report\response\ReturnHandler;
use report\base\Json;
use report\user\Cookie;
use report\user\Session;

$account = isset($account) ? trim($account) : '';
$password = isset($smsVerifyCode) ? trim($smsVerifyCode) : '';
//$account='TW17050001';
//$password=$account."3edc$RFV";
if(empty($account) || empty($password)){
    ReturnHandler::response(32);
}

$result = Auth::verify($account, $password,"");
if($result['code'] != 0){
    //ReturnHandler::response(3, null, $result['desc']);
    ReturnHandler::response(3,null,Json::encode($result));
}
// $record = Json.decode($result['desc']);//array{"account","accountLevel"};
// $obj=array();
// $obj['account']=$record['account'];
// $obj['accountLevel']=$record['accountLevel'];
// SESSION::save($obj);
ReturnHandler::response(1);
?>
