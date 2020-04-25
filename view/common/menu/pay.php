<?php
use report\tool\RegisterTool;
use report\user\Auth;
use report\user\Session;
$session = array(
    'payTime' =>  true,
);
Session::save($session);
$step=isset($g['payStep'])?$g['payStep']:'';
$transCode=isset($g['transCode'])?$g['transCode']:'1';
if (isset($g['transCode'])){
    $totalCost=$g['totalCost'];
    $obj=array('totalCost'=>$totalCost);
    Session::save($obj);
}
if ($transCode=='1'){
    $tf=TRANSFee;
}
else{
    $tf=SEVENFee;
}
if (!Auth::isLogin() && (Session::get('tmpMBNO')==FALSE)){
    $reg =isset($g['reg'])?$g['reg']:'';
    if ($reg==''){
        include 'mLogin.php';
    }
    else{
        include 'mRegister.php';
    }
}
else{
//     if (Session::get('tmpMBNO')!=FALSE){
//         RegisterTool::OfficialRegistration();
//     }
    
    $tFee=isset($g['tFee'])?$g['tFee']:$tf;
    if (Session::get('transCode')==null){
        if(isset($totalCost)){
            $obj=array('transCode'=>$transCode,'tFee'=>$tFee,'totalCost'=>$totalCost);
            Session::save($obj);
        }
    }
    else{
        $transCode=Session::get("transCode");
        $tFee=Session::get("tFee");
    }
    switch ($step){
        case "2":
            include "pay3.php";
            break;
        case "1":
            include "pay2.php";
            break;
        case "0":
            include "pay1.php";
            break;
        default:
            include "pay1.php";
//             if ($transCode=='1'){
//                 include "pay1.php";
//             }
//             else{
//                 include "pay0.php";
//             }
            break;
    }
}
include "forLoginScript.php";