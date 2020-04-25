<?php
use report\user\Session;
use report\tool\ShoppingCart;
$cart=ShoppingCart::getCartDataList();
$num=$cart['cartNo'];
?>

<div id="shop_main" class="row">
<h4>採購明細
	<table class="table table-striped">
<?php
$total=0;
$totalpv=0;$number=$ci['number'];
$unit=$ci['unit'];
$pv=$ci['pv'];
for ($i=0;$i<$num;$i++){
    $ct=$cart[$i];
    $prodNo=$ct['prodNo'];
    $prodName=$ct['prodName'];
    $number=isset($g[$prodNo])?$g[$prodNo]:1;
    $price=$ct['price'];
    $prices=$price*$number;
    $unit=$ct['unit'];
    $pv=$ct['pv'];
    $pvs=$pv*$number;
    $total=$total + $prices;
    $totalpv=$totalpv + $pvs;
//     $number=$ci['number'];
//     $unit=$ci['unit'];
//     $pv=$ci['pv'];
    $str = "<td>$prodName&nbsp;&nbsp;</td> <td>單價：".$price."元($unit)&nbsp;&nbsp;</td> <td>採購：$number($unit)&nbsp;&nbsp;</td> <td>小計：".$prices."元 PV:$pvs</td>";
?>
		<tr>
			<?php echo $str?></li>
		</tr>
<?php 
}
$strTotal="總金額：".$total."元, 總PV：$totalpv";
//ShoppingCart::deleteAllCartData();
?>
	<tr><td colspan="4"><?php echo $strTotal?></td></tr>
	</table>
</h4>
	<div>
		<a href="index.php?menuId=9a" class="btn btn-lg btn-info">
			<span class="glyphicon glyphicon-list-alt"></span> 繼續購物
		</a>
		 &nbsp;
		<a href="index.php?menuId=9e" class="btn  btn-lg btn-primary">
			<span class="glyphicon glyphicon-usd"></span> 直接付款
		</a>
	</div>
	<br>

</div>