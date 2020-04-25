<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

require_once( __DIR__."/../init.inc.php" );

use report\user\Auth;
use report\response\ReturnHandler;
use report\base\Json;
use report\user\Cookie;
use report\user\Session;
use report\user\comission;

$account = isset($account) ? trim($account) : '';
$password = isset($password) ? trim($password) : '';
//$account='TW17050001';
//$password=$account."3edc$RFV";
if(empty($account) || empty($password)){
    ReturnHandler::response(32);
}

$result = Auth::login($account, $password,"");
if($result['code'] != 0){
    //ReturnHandler::response(3, null, $result['desc']);
    ReturnHandler::response(3,null,Json::encode($result));
}
else{
    $obj = comission::getData(Session::get('account'));
    if (($obj['code'])==0){
        $uneff=$obj['uneff'];
        $eff=$obj['eff'];
        $msg="生效購物點數:$eff, 待生效購物點數:$uneff";
        $data=array('uneff'=>$uneff,'eff'=>$eff);
        Session::save($data);
    }
    else{
        $msg='';
    }
}
// $record = Json.decode($result['desc']);//array{"account","accountLevel"};
// $obj=array();
// $obj['account']=$record['account'];
// $obj['accountLevel']=$record['accountLevel'];
// SESSION::save($obj);
ReturnHandler::response(1,null,$msg);
?>
