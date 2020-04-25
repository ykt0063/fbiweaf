<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

require_once( __DIR__."/../init.inc.php" );


use report\response\ReturnHandler;
use report\base\Json;
use report\user\Cookie;
use report\user\Session;
use report\user\Auth;
$ckCode=Session::get('checkNum');
$verifycode=isset($verifycode)?trim($verifycode):'';
//$ckCode=$verifycode;
if(strcmp($ckCode,$verifycode)==0){
    $ckAns=1;
}
else{
    $ckAns=0;
}
$account = isset($mbno) ? trim($mbno) : '';
$name = isset($name) ? trim($name) : '';
$addr = isset($addr) ? trim($addr) : '';
$birth = isset($birth) ? trim($birth) : '';
$tel = isset($tel) ? trim($tel) : '';
$email = isset($email) ? trim($email) : '';
//$account='TW17050001';
//$password=$account."3edc$RFV";

$result = Auth::editData($account, $name,$addr,$birth,$tel,$email);
if($result['code'] != 0){
    //ReturnHandler::response(3, null, $result['desc']);
    ReturnHandler::response(3,null,Json::encode($result));
}
else{
    $msg="資料變更成功";
    ReturnHandler::response(1,null,$msg);
}
// $record = Json.decode($result['desc']);//array{"account","accountLevel"};
// $obj=array();
// $obj['account']=$record['account'];
// $obj['accountLevel']=$record['accountLevel'];
// SESSION::save($obj);
?>
