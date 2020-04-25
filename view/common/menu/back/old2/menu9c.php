<?php
use report\user\Session;
use report\tool\ShoppingCart;
$account='';
$num=0;
$result=array();
$account=SESSION::get('account');
$opCode=isset($g['opCode'])?$g['opCode']:'';
if ($opCode=='delCart'){
    $prodNo=isset($g['prodNo'])?$g['prodNo']:'';
    ShoppingCart::deleteCartData($prodNo);
//     $opData=isset($g['opData'])?$g['opData']:'';
//     $obj=json_decode($opData);
//     $num=$obj->{'num'};
//     for ($i=0;$i<$num;$i++){
//         $data=$obj[$i];
//         $prodNo=$data['$prodNo'];
// //         $price=$data['$price'];
//         $number=$data['$number'];
// //         $pv=$data['$pv'];
//         ShoppingCart::editCart($prodNo, $number);
//     }
}
if ($opCode='editCart'){
    $prodNo=isset($g['prodNo'])?$g['prodNo']:'';
    $number=isset($g['number'])?$g['number']:'1';
    if ($prodNo!=''){
        ShoppingCart::editCart($prodNo, $number);
    }
//     $number=$ci['number'];
//     $unit=$ci['unit'];
//     $pv=$ci['pv'];
}
$cart=ShoppingCart::getCartDataList();
$str='';
$num=$cart['cartNo'];
if ($num>0){
    $totalPrice=0;
    $totalPV=0;
    for ($i=0;$i<$num;$i++){
        $ci=$cart[$i];
        $totalPrice=$totalPrice+$ci['price']*$ci['number'];
        $totalPV=$totalPV+$ci['pv']*$ci['number'];
    }
    $str="(總金額:".$totalPrice." 總PV:".$totalPV.")";
}
?>
<form action="index.php" method="get" name="orderForm">
	<div id="shop_main" class="row">
<h4>購物車 <?php echo $str?></h4>
<?php 
$num=$cart['cartNo'];
for($i=0;$i<$num;$i++){
    $ci=$cart[$i];
    $prodNo=$ci['prodNo'];
    $prodName=$ci['prodName'];
    $price=$ci['price'];
    $number=$ci['number'];
    $unit=$ci['unit'];
    $pv=$ci['pv'];
    $str="opCode=delCart&prodNo=".$prodNo;
?>
	<div class="row table-responsive">
		<div class="col-md-6 text-center">
			<table class="table">
				<tr>
					<td style="width: 40%">
						<img src="<?php echo WEB_ASSET_URL?>images/<?php echo $prodNo?>.jpg" height="175" alt="<?php echo $prodName?>">
					</td>
					<td style="width: 60%">
						<h4><?php echo $prodName?></h4>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-md-6 text-center">
			<table class="table">
				<tr>
					<td style="width: 30%">
						<h4><?php echo $price?>元/<?php echo $unit?></h4>
					</td>
					<td style="width: 50%">
						<input type="number" min="1" style="width: 4em" class="target" value="<?php echo $number?>" size="3" name="<?php echo $prodNo?>" id="<?php echo $prodNo?>" style="text-align:right;"><?php echo $unit?>
						<a href="index.php?menuId=9c&<?php echo $str?>" class="btn btn-lg btn-danger">
							<span class="glyphicon glyphicon-remove"></span> 刪除
						</a>			
						
					</td>
					<td style="width: 20%">
						<h4>PV:<?php echo $pv?></h4>
						<br>
						<div>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
<?php
}
if ($num>0){
    $enable="";
}
else{
    $enable="disabled";
}
?>
	<div>
		<a href="index.php?menuId=9a" class="btn btn-lg btn-info">
			<span class="glyphicon glyphicon-list-alt"></span> 回產品清單
		</a>
		 &nbsp;
		<button type="submit" class="btn  btn-lg btn-primary" <?php echo $enable?>>
			<span class="glyphicon glyphicon-usd"></span> 準備付款
		</button>
	</div>
	<br>
</div>
<input type="hidden" id="menuIds" name="menuIds" value="9d">
</form>