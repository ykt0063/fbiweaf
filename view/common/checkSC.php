<?php

use report\order\Products;
use report\tool\ShoppingCart;
use report\user\Session;
use report\user\product;
if ((isset($g['addNumber'])) && (isset($g['productID']))){
    $number=$g['addNumber'];
    $prodID=$g['productID'];
    $prodName=$g['productName'];
    $unit=$g['unit'];
    $price=$g['price'];
    $pv=$g['pv'];
    $exch_points=$g['exch_points'];
    ShoppingCart::add2Cart($prodID, $price, $number, $pv,$prodName,$unit,$exch_points);
}
Session::delete("prodPic");
$obj=array("prodPic"=>product::getAllPic());
Session::save($obj);
$SClear=Session::get('scClear');
if ($SClear){
    $mid=0;
    Session::delete('scClear');
    Session::delete('totaExch_points');
}
// if (isset($scClear)){
//     $obj=Session::get('orderM');
//     $obj1=Session::get('orderM1');
//     $obj['InvoiceNo']=$obj1['InvoiceNo'];
//     $obj['CargoNo']=$obj1['CargoNo'];
//     $obj['Card_NO']=$obj1['Card_NO'];
//     $obj['ApproveCode']=$obj1['ApproveCode'];
//     if ($obj && $obj1){
//         Products::SetOfficialOrder($obj);
//         $payEP=$obj['payEP'];
//         $eff=Session::get('eff');
//         //$uneff=Session::get('uneff');
//         $eff=$eff-$payEP;
//         // $uneff=$uneff + $payEP;
//         $obj=array('eff'=>$eff);
//         Session::save($obj);
//     }
//         ShoppingCart::deleteAllCartData();
//     Session::delete('payTime');
//     //     $tid=SESSION::get('tid');
//     //     $date=SESSION::get('date');
//     Session::delete('objStr');
//     Session::delete('orderM');
//     Session::delete('orderM1');
//     Session::delete('tid');
//     Session::delete('date');
//     Session::delete('transCode');
//     Session::delete('storeID');
//     Session::delete('storeName');
//     Session::delete('storeAddr');
//     Session::delete('storeType');
//     Session::delete('storeMsg');
// }
if ($mid=='sc'){
    $opCode=isset($g['opCode'])?$g['opCode']:'';
    if ($opCode=='delete'){
        $prodNo=isset($g['prodNo'])?$g['prodNo']:'';
        if ($prodNo!=''){
            ShoppingCart::deleteCartData($prodNo);
        }
    }
}
$kindNumber=ShoppingCart::getKindNumber();
if($mid=='pay'){
    $kindNumber=0;
}
$scTotal=ShoppingCart::getTotalCost();
