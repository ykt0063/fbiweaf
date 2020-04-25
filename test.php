<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require_once( __DIR__."/init.inc.php" );

//UTF-8編碼
header('Content-Type: text/html; charset=utf-8');
use report\base\Json;
use report\order\Products;
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
//$merchantID = SESSION::get('web');
$transPassword = 'S991925S'; //交易密碼（可登入商家專區至「密碼修改」處設定，此密碼非後台登入密碼）
//$transPassword = SESSION::get('tradePwd');
//$snote1 = SESSION::get('note1');
//$snote2 = SESSION::get('note2');

//回傳參數值
$buysafeno = 'C000092002090000149'; //紅陽交易編號
$web = ''; //商家代號
// if ($merchantID != $web) {
//     $msg="我方代碼：$merchantID,收到廠商代碼：$web,商家代號錯誤";
//     //exit('商家代號錯誤');
//     exit($msg);
// }
$UserNo = ''; //用戶編號
$Td = '202002090021N'; //商家訂單編號
$MN = '60'; //交易金額
$webname = ''; //網站名稱
$Name = ''; //消費者姓名
$note1 = ''; //備註1
$note2 = ''; //備註2
// $ApproveCode = getPostData('ApproveCode'); //交易授權碼（交易成功時才有值）
// $Card_NO = getPostData('Card_NO'); //授權卡號後4碼
$SendType = '1'; //傳送方式，1:背景傳送、2:網頁傳送、3:金流模組系統間回傳
$errcode = '00'; //交易回覆代碼
$errmsg = ''; //錯誤訊息（交易成功為空字串）
// $Card_Type = getPostData('Card_Type'); //交易類別
$InvoiceNo = ''; //發票號碼
$CargoNo = 'F04000140209'; //交貨便代碼
// $StoreID = getPostData('StoreID'); //取貨門市店號
// $StoreName = urldecode(getPostData('StoreName')); //取貨門市店名
// $StoreType = getPostData('StoreType'); //物流狀態代碼
// $StoreMsg = urldecode(getPostData('StoreMsg'//)); //物流狀態解釋
$ChkValue = getChkValue($web . $transPassword . $buysafeno . $MN . $errcode); //交易檢查碼（SHA1雜湊值）
//$postData=Json::encode($_POST);
// if ($note1!=$snote1 || $note2!=$snote2){
//     exit('備註資料錯誤');
// }
//自行設計更新資料庫訂單狀態
if (!empty($errcode) && $ChkValue == getChkValue($web . $transPassword . $buysafeno . $MN . $errcode)) {
    if ($errcode == '00') {
        //付款成功
        Products::SunShipPaidData($buysafeno,$web,$Td,$MN,$errcode,$errmsg,$InvoiceNo,$CargoNo);
    } else {
        //付款失敗
    }
    exit('0000');
} else {
    exit('交易檢查碼錯誤');
}

function getPostData($key)
{
    return array_key_exists($key, $_POST) ? $_POST[$key] : '';
}

/*
 * 檢查交易檢查碼是否正確（SHA1雜湊值）
 */
function getChkValue($string)
{
    return strtoupper(sha1($string));
}
?>