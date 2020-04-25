<?php
use report\user\Session;
use report\order\Products;
use report\tool\ShoppingCart;
use report\tool\RegisterTool;
$cart=ShoppingCart::getCartDataList();
$str="";
$num=$cart['cartNo'];
if ($num>0){
    $str='您已選購成功,資料如下\n';
    $totalPrice=0;
    $totalPV=0;
    for ($i=0;$i<$num;$i++){
        $ci=$cart[$i];
        $prodNo=$ci['prodNo'];
        $prodName=$ci['prodName'];
        $price=$ci['price'];
        $number=$ci['number'];
        $unit=$ci['unit'];
        $pv=$ci['pv'];
        $str=$str.$prodName." 數量:".$number.$unit." 單價:".price."元 小計:".$price*$number."元\n";
        $totalPrice=$totalPrice+$ci['price']*$ci['number'];
        $totalPV=$totalPV+$ci['pv']*$ci['number'];
    }
    $str=$str."(總金額:".$totalPrice." 總PV:".$totalPV.")";
    ShoppingCart::deleteAllCartData();
    RegisterTool::OfficialRegistration();
}
?>
<script>
function myFunction() {
    alert(<?=$str?>);
    window.location.href = 'index.php';
}
</script>
