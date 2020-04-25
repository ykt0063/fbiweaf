<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

require_once( __DIR__."/../init.inc.php" );


use report\response\ReturnHandler;
use report\base\Json;
use report\user\Cookie;
use report\user\Session;
use report\user\Auth;
use report\user\sms;
use report\user\email;
$ckCode=Session::get('checkNum');
$verifycode=isset($verifycode)?trim($verifycode):'';
//$ckCode=$verifycode;
if(strcmp($ckCode,$verifycode)==0){
    $ckAns=1;
}
else{
    $ckAns=0;
}
//$ckAns=1;
$account = isset($account) ? trim($account) : '';
$name = isset($name) ? trim($name) : '';
$email = isset($email) ? trim($email) : '';
$idendifyWay=isset($identifyWay) ? trim($identifyWay) : 1;
//$account='TW17050001';
//$password=$account."3edc$RFV";
$sendWay="";
if(empty($account)){
    ReturnHandler::response(32,null,'帳號不可空白');
}
if ($idendifyWay==1){
    if (empty($name)){
        ReturnHandler::response(32,null,'姓名不可空白');
    }
    $sendWay="簡訊";
}
else{
    if (empty($email)){
        ReturnHandler::response(32,null,'email不可空白');
    }
    $sendWay="email";
}
$result = Auth::forgetPWD($account, $idendifyWay,$name,$email);
if($result['code'] != 0){
    //ReturnHandler::response(3, null, $result['desc']);
    ReturnHandler::response(3,null,Json::encode($result));
}
else{
    $desc=$result['desc'];
    if ($idendifyWay==1){
        $ret=sms::sendPWD($account,$desc);
    }
    else{
        email::sendMail($email,$desc);        
    }
    $msg="密碼已透過".$sendWay."發送成功！！請檢收。";
    ReturnHandler::response(1,null,$msg);
}
// $record = Json.decode($result['desc']);//array{"account","accountLevel"};
// $obj=array();
// $obj['account']=$record['account'];
// $obj['accountLevel']=$record['accountLevel'];
// SESSION::save($obj);
?>
