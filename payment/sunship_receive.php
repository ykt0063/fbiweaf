<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require_once( __DIR__."../../init.inc.php" );

//UTF-8編碼
header('Content-Type: text/html; charset=utf-8');
use report\base\Json;
use report\order\Products;
use report\user\Auth;
use report\user\Session;




//-------------------------------------------
//  商家端交易結果接收程式demo（信用卡交易）
//
//  運作原理：Form POST Method(HTTPS)
//  流程：購物網站->send.php->紅陽系統（Etopm.aspx）->receive.php（本程式）
//  參數值說明請參見技術文件
//-------------------------------------------

//設定（※請修改）
//$merchantID = 'S1234567890'; //商家代號（信用卡）（可登入商家專區至「服務設定」中查詢Buysafe服務的代碼）



//回傳參數值
$buysafeno = getPostData('buysafeno'); //紅陽交易編號
$web = getPostData('web'); //商家代號
$Td = getPostData('Td'); //商家訂單編號
$MN = getPostData('MN'); //交易金額
$webname = urldecode(getPostData('webname')); //網站名稱
$Name = urldecode(getPostData('Name')); //消費者姓名
$note1 = urldecode(getPostData('note1')); //備註1
$note2 = urldecode(getPostData('note2')); //備註2
// $ApproveCode = getPostData('ApproveCode'); //交易授權碼（交易成功時才有值）
// $Card_NO = getPostData('Card_NO'); //授權卡號後4碼
$SendType = getPostData('SendType'); //傳送方式，1:背景傳送、2:網頁傳送、3:金流模組系統間回傳
// $errcode = getPostData('errcode'); //交易回覆代碼
// $errmsg = urldecode(getPostData('errmsg')); //錯誤訊息（交易成功為空字串）
// $Card_Type = getPostData('Card_Type'); //交易類別
// $InvoiceNo = getPostData('InvoiceNo'); //發票號碼
$CargoNo = getPostData('CargoNo'); //交貨便代碼
$StoreID = getPostData('StoreID'); //取貨門市店號
$StoreName = urldecode(getPostData('StoreName')); //取貨門市店名
$StoreType = getPostData('StoreType'); //物流狀態代碼
$StoreMsg = urldecode(getPostData('StoreMsg')); //物流狀態解釋
$ChkValue = getPostData('ChkValue'); //交易檢查碼（SHA1雜湊值）
//$postData=Json::encode($_POST);
// if ($note1!=$snote1 || $note2!=$snote2){
//     exit('備註資料錯誤');
// }
if ((SESSION::get('web')!=null)){
    $merchantID = SESSION::get('web');
    //$transPassword = 'S991925S'; //交易密碼（可登入商家專區至「密碼修改」處設定，此密碼非後台登入密碼）
    $transPassword = SESSION::get('tradePwd');
    $snote1 = SESSION::get('note1');
    $snote2 = SESSION::get('note2');
    if ($merchantID != $web) {
        $msg="我方代碼：$merchantID,收到廠商代碼：$web,商家代號錯誤";
        //exit('商家代號錯誤');
        exit($msg);
    }
}
else{
    $transPassword=Auth::getSunshipData($web,$Td,$CargoNo);
}
//自行設計更新資料庫訂單狀態
//$qq=getChkValue($web . $transPassword . $buysafeno . $StoreType);
//$qq1=getChkValue($web . $transPassword . $buysafeno . $MN . $CargoNo);
if (!empty($StoreType) && $ChkValue == getChkValue($web . $transPassword . $buysafeno . $StoreType)) {
    //物流狀態回傳
    switch ($StoreType) {
        case '101':
            //表示貨抵達取貨門市
            break;
        case '1010':
            //表示取貨完成
            break;
        case '1B1B':
            //表示欲退貨或退貨取貨完成
            break;
    }
    Products::SunshipLogisticsStatusUpdate($Td, $StoreType, $StoreMsg);
    exit;
} elseif (!empty($CargoNo) && $ChkValue == getChkValue($web . $transPassword . $buysafeno . $MN . $CargoNo)) {
    $obj=array();
    $obj['buysafeno']=$buysafeno;
    $obj['Td']=$Td;
    $obj['MN']=$MN;
    $obj['Name']=$Name;
    $obj['note1']=$note1;
    $obj['note2']=$note2;
//     $obj['ApproveCode']=$ApproveCode;
//     $obj['Card_NO']=$Card_NO;
    //$transCode=Session::get('transCode');
    Products::SunShipReceiveData($buysafeno,$web,$Td,$MN,$note1,$note2,$SendType,$CargoNo,$StoreID,$StoreName,$StoreType,$StoreMsg);
    //Products::SetResponse($web,$buysafeno,$Td,$MN,$ApproveCode,$Card_NO,$errcode,$errmsg,$InvoiceNo,$postData,$transCode,$obj);
    //交易結果回傳
    $obj=array('storeID'=>$StoreID,'storeName'=>$StoreName,'storeType'=>$StoreType,'storeMsg'=>$StoreMsg);
    Session::save($obj);
    header('Location: https://'.$_SERVER['SERVER_NAME'].'/index.php?menuID=pay&payStep=2&web='.$web.'&tradeNo='.$Td);
//     if (strcmp($errcode, '00')==0) {
//         //付款成功
//         //redirect to menu9f
//         //$obj=Session::get('orderM');
//         $obj=array();
//         $obj['InvoiceNo']=$InvoiceNo;
//         $obj['CargoNo']=$CargoNo;
//         $obj['Card_NO']=$Card_NO;
//         $obj['ApproveCode']=$ApproveCode;
//         $objs=array('orderM1'=>$obj);
//         Session::save($objs);
//         if ($CargoNo<>''){
//             $obj=array('storeID'=>$StoreID,'storeName'=>$StoreName,'storeType'=>$StoreType,'storeMsg'=>$StoreMsg);
//             Session::save($obj);
//         }
//         header('Location: https://'.$_SERVER['SERVER_NAME'].'/index.php?menuID=pay&payStep=2&web='.$web.'&tradeNo='.$Td);
//     } else {
//         //付款失敗
//         exit('付款失敗');
//     }
    if ($SendType == 1) {
        exit('0000');
    }
} else {
    exit('交易檢查碼錯誤');
}

//顯示回傳的參數（以下為debug用，正式環境應刪除）
// echo '<br>buysafeno=' . $buysafeno; //紅陽交易編號
// echo '<br>web=' . $web; //商家代號
// echo '<br>Td=' . $Td; //商家訂單編號
// echo '<br>MN=' . $MN; //交易金額
// echo '<br>webname=' . $webname; //網站名稱
// echo '<br>Name=' . $Name; //消費者姓名
// echo '<br>note1=' . $note1; //備註1
// echo '<br>note2=' . $note2; //備註2
// echo '<br>ApproveCode=' . $ApproveCode; //交易授權碼（交易成功時才有值）
// echo '<br>Card_NO=' . $Card_NO; //授權卡號後4碼
// echo '<br>SendType=' . $SendType; //傳送方式，1:背景傳送、2:網頁傳送、3:金流模組系統間回傳
// echo '<br>errcode=' . $errcode; //交易回覆代碼
// echo '<br>errmsg=' . $errmsg; //錯誤訊息（交易成功為空字串）
// echo '<br>Card_Type=' . $Card_Type; //交易類別
// echo '<br>InvoiceNo=' . $InvoiceNo; //發票號碼
// echo '<br>CargoNo=' . $CargoNo; //交貨便代碼
// echo '<br>StoreID=' . $StoreID; //取貨門市店號
// echo '<br>StoreName=' . $StoreName; //取貨門市店名
// echo '<br>StoreType=' . $StoreType; //物流狀態代碼
// echo '<br>StoreMsg=' . $StoreMsg; //物流狀態解釋
// echo '<br>ChkValue=' . $ChkValue; //交易檢查碼（SHA1雜湊值）
//（以上為debug用，正式環境應刪除）

function getPostData($key)
{
    return array_key_exists($key, $_POST) ? $_POST[$key] : '';
}

/**
 * 檢查交易檢查碼是否正確（SHA1雜湊值）
 */
function getChkValue($string)
{
    return strtoupper(sha1($string));
}
?>