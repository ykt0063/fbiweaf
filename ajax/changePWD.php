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
$passwo = isset($password) ? trim($password) : '';
$oldpassword = isset($oldPWD) ? trim($oldPWD) : '';
//$account='TW17050001';
//$password=$account."3edc$RFV";
if(empty($account) || empty($oldpassword) || empty($password)){
    ReturnHandler::response(32,null,'新舊密碼不可空白');
}

$result = Auth::changepwd($account, $oldpassword,$password);
if($result['code'] != 0){
    //ReturnHandler::response(3, null, $result['desc']);
    ReturnHandler::response(3,null,Json::encode($result));
}
else{
    $msg="變更密碼成功！！登出後，請用新密碼登錄。";
    ReturnHandler::response(1,null,$msg);
}
// $record = Json.decode($result['desc']);//array{"account","accountLevel"};
// $obj=array();
// $obj['account']=$record['account'];
// $obj['accountLevel']=$record['accountLevel'];
// SESSION::save($obj);
?>
