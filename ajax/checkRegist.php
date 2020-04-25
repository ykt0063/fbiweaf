<?php
use report\base\Json;
use report\base\Register;
use report\response\ReturnHandler;
use report\tool\RegisterTool;
use report\user\Session;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

require_once( __DIR__."/../init.inc.php" );
$ckCode=Session::get('checkNum');
$verifycode=isset($verifycode)?trim($verifycode):'';
//$ckCode=$verifycode;
if(strcmp($ckCode,$verifycode)==0){
    $ckAns=1;
}
else{
    $ckAns=0;
}

//$mbName = isset($mbName) ? trim($mbName) : '';
$mbName = isset($name) ? trim($name) : '';
//$bossId = isset($bossId) ? trim($bossId) : '';
$bossId = isset($account) ? trim($account) : '';
$passwd = isset($password)?trim($password) : '';
if (strlen($passwd)==0){
    $passwd=substr($account,-4);
}
$sex = isset($sex) ? trim($sex) : '1';
if ($sex=='1'){
    $sex='男';
}
else{
    $sex='女';
}
//$birth = isset($birth) ? trim($birth) : '';
$birth = isset($birth) ? trim($birth) : '';
// $pg_date = isset($pg_date) ? trim($pg_date) : '';
$pg_date = date("Y-m-d H:i:s");
//$pg_yymm = isset($pg_yymm) ? trim($pg_yymm) : '';
$pg_yymm = date("Ym");
$email = isset($email) ? trim($email) : '';
//$tel1 = isset($tel1) ? trim($tel1) : '';
$tel1 = isset($telephone) ? trim($telephone) : '';
$tel2 = isset($tel2) ? trim($tel2) : '';

//$mtel = isset($mtel) ? trim($mtel) : '';
//$mtel = isset($mobilePhone) ? trim($mobilePhone) : '';
$mtel = isset($account) ? trim($account) : '';
$faxNo = isset($faxNo) ? trim($faxNo) : '';
//$address1 = isset($address1) ? trim($address1) : '';
$address1 = isset($address) ? trim($address) : '';
$address2 = isset($address2) ? trim($address2) : '';
$post1 = isset($post1) ? trim($post1) : '';
$post2 = isset($post2) ? trim($post2) : '';
$trueIntroNo = isset($trueIntroNo) ? trim($trueIntroNo) : '';
$trueIntroName = isset($trueIntroName) ? trim($trueIntroName) : '';
$acName = isset($acName) ? trim($acName) : '';
$likeMBNO = isset($likeMBNO) ? trim($likeMBNO) : '';
$giveMethod = isset($giveMethod) ? trim($giveMethod) : '';
$giveMethodNo = isset($giveMethodNo) ? trim($giveMethodNo) : '';
$bankAc = isset($bankAc) ? trim($bankAc) : '';
$mbStatus = isset($mbStatus) ? trim($mbStatus) : '';
$idKind = isset($idKind) ? trim($idKind) : '';
//$grade = isset($gradeName) ? trim($gradeName) : '';
$grade='';
//$obj=Json::decode($grade);
//$gradeName=$obj->{'gradeName'};
$gradeName='';
//$gradeClass=$obj->{'gradeClass'};
$gradeClass='';
$comefrom = isset($comefrom) ? trim($comefrom) : '';
$sendMethod = isset($sendMethod) ? trim($sendMethod) : '';
$warehouse = isset($warehouse) ? trim($warehouse) : '';
$obj=JSON::decode($warehouse);
//$warehouseNo=$obj->{'warehouseNo'};
$warehouseNo='';
//$warehouseName=$obj->{'warehouseName'};
$warehouseName='';
$tag=true;
//if (empty($bossId)||empty($mbName)||empty($birth)||empty($tel1)||empty($address1)||empty($trueIntroNo)||empty($trueIntroName)||empty($giveMethod)||empty($giveMethodNo)||empty($bankAc)){
//if (empty($bossId)||empty($mbName)||empty($birth)||empty($tel1)||empty($address1)||empty($trueIntroNo)){
if (empty($trueIntroNo)){
    $trueIntroNo='0921066313';
}
if (empty($bossId)||empty($mbName)){
    ReturnHandler::response(32,null,'必要資料不可空白');
}
if (!isset($readMRight) | !isset($readPrivacy)){
    ReturnHandler::response(32,null,'會員權益與網站隱私必須先閱讀');
}
else{
    $mRightTag="Y";
    $privacyTag="Y";
    if ($ckAns==1){//驗證碼正確
        $regClass = new Register($bossId,$mbName,$bossId,$sex,$birth,$pg_date,
            $pg_yymm,$email,$tel1,$tel2,$mtel,$faxNo,$address1,
            $post1,$address2,$post2,$trueIntroNo,$trueIntroName,
            $acName,$likeMBNO,$giveMethod,$giveMethodNo,$bankAc,
            $mbStatus,$idKind,$gradeName,$gradeClass,$comefrom,
            $sendMethod,$warehouseNo,$warehouseName,$passwd);
        //$obj=RegisterTool::register($regClass->getString(),$bossId,$trueIntroNo);
        $obj=RegisterTool::register($bossId,$mbName,$passwd,$trueIntroNo,$address1,$tel1,$mtel,$birth,$sex,$mRightTag,$privacyTag);
        if ($obj['code']!=1){
            //     ReturnHandler::response(3,null,Json::encode($obj));
            ReturnHandler::response(3,null,$obj['desc']);
        }
        else{
            // RegisterTool::OfficialRegistration();
            $session=array();
            $session['smsID']=$bossId;
            Session::save($session);
            //         ReturnHandler::response(1,null,$obj['desc']);
            ReturnHandler::response(1,null,'');
        }
    }
    else{
        ReturnHandler::response(32,null,'驗證碼不正確');
    }
}