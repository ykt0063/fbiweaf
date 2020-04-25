<?php
use report\user\Session;
use report\order\Products;
use report\tool\ShoppingCart;
use report\tool\image;
$account='';
$str='';
$num=0;
$result=array();
if (null!=SESSION::get('account')){
    $account=SESSION::get('account');
    //$strWeekNolist = Personal::GetWeekNoList($weekNo);
    $result = Products::GetList();
}
$prodNo=isset($g['prodNo'])?$g['prodNo']:'';
$number=isset($g['number'])?$g['number']:'1';


foreach( $result as $row ){
    $prod_no=$row['PROD_NO'];
    $prod_name=$row['PROD_NAME'];
    $sug_price=$row['SUG_PRICE'];
    $prod_unit=$row['PROD_UNIT'];
    $pv=$row['PV'];
    if ($prodNo!='' && $prodNo==$prod_no){
        ShoppingCart::add2Cart($prodNo, $sug_price, $number, $pv, $prod_name, $prod_unit);
    }
}
?>
<div id="shop_main" class="row">
	<h3>線上購物</h3>
	<div class="row">
		<div class="col-md-5"></div>
		<div class="col-md-4">
		</div>
		<div class="col-md-2">
<?php 
$cart = ShoppingCart::getCartDataList();
$num=$cart['cartNo'];
//if ($num>0){
    $prises=0;
    $pvs=0;
?>
			<div id="cart" class="btn-group btn-block">
				<button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="btn btn-inverse btn-block btn-lg dropdown-toggle" aria-expanded="false"><span id="cart-total"><i class="fa fa-shopping-cart"></i>
						<span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;已選取<?php echo $num?>個產品
					</span>
				</button>
				<ul class="dropdown-menu pull-right">
				<li>
					<table class="table table-striped">
					<tbody>
					<tr><th class="text-left">產品名稱</th><th class="text-right">數量</th><th class="text-right">小計</th></tr>
<?php 
    for ($i=0;$i<$num;$i++){
        $ci=$cart[$i];
        $price=$ci["price"];
        $pv=$ci['pv'];
        $name=$ci['prodName'];
        $number=$ci['number'];
        $prises=$prises+$price*$number;
        $pvs=$pvs+$pv*$number;
?>
					<tr>
					<td class="text-left"><?=$name?> </td>
					<td class="text-right">x <?=$number?></td>
					<td class="text-right"><?=$number*$price?></td>
					</tr>
<?php 
    }
?>
					</tbody></table>
				</li>
				<li>
					<div>
						<table class="table table-bordered">
						<tbody><tr>
						<td class="text-right"><strong>合計總價</strong></td>
						<td class="text-right"><?=$prises ?>(元)</td>
						</tr>
						<tr>
						<td class="text-right"><strong>合計PV</strong></td>
						<td class="text-right"><?=$pvs?></td>
						</tr>
						</tbody></table>
					</div>
				</li>
<?php 
if ($num>0){
?>				
				<li>
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<a href="index.php?menuId=9c" class="btn btn btn-basic">
								<span class="glyphicon glyphicon-shopping-cart"></span> 查看購物車
							</a>
						</div>
						<div class="col-md-4"></div>
					</div>
				</li>
<?php 
}
?>
				</ul>
			</div>
<?php 
//}
?>		</div>
		<div class="col-md-1">
		</div>

	</div>
<?php 
$str="";
foreach( $result as $row ){
    $prod_no=$row['PROD_NO'];
    $prod_name=$row['PROD_NAME'];
    $sug_price=$row['SUG_PRICE'];
    $prod_unit=$row['PROD_UNIT'];
    $pv=$row['PV'];
?>
	<div class="col-md-4 text-center">
    	<div class="thumbnail">
    		<a href="index.php?menuId=9b&prodNo=<?=$prod_no?>">
    			<img src="<?=WEB_SITE_URL?>assets/images/<?=$prod_no?>.jpg" alt="<?=$prod_name?>">
    		</a>
    		<div class="caption">
    			<div style="">
    				<h5><a href="index.php?menuId=9b&prodNo=<?=$prod_no?>">產品:<?=$prod_name?><br>單價:<?=$sug_price?>元/<?=$prod_unit?></a></h5>
    				<form id="orderForm" action="index.php" method="POST">
    					<input type="text" value="1" size="3" name="number" style="text-align:right;">&nbsp;
    					<input type="hidden" id="menuIds" name="menuIds" value="9a">
    					<input type="hidden" id="prodNo" name="prodNo" value="<?=$prod_no?>">
    					<button type="submit" class="btn  btn btn-warning">
    						<span class="glyphicon glyphicon-shopping-cart"></span> 放入購物車
    					</button>
    				</form>
    			</div>
    		</div>
		</div>
	</div>

<?php 
//      image::getSImage("$prod_no.jpg");

//     $str=$str."<div class=\"col-md-4 text-center\">";
//     $str=$str." <div class=\"thumbnail\">";
//     //      $str=$str."  <a href=\"index.php?menuId=9b&prodNo=".$prod_no."\"><img src=\"".WEB_ASSET_URL."images/".$prod_no.".jpg\" height=\"175\" alt=\"".$prod_name."\"></a>";
//     $str=$str."  <a href=\"index.php?menuId=9b&prodNo=".$prod_no."\"><img src=\"".WEB_SITE_URL."".$prod_no.".jpg\"  alt=\"".$prod_name."\"></a>";
//     //           $imgData = image::getSImage("$prod_no.jpg");
//     //      image::getSImage("$prod_no.jpg");
//     //     $str=$str."  <a href=\"index.php?menuId=9b&prodNo=".$prod_no."\">".$imgData."</a>";
//     $str=$str."  <div class=\"caption\">";
//     $str=$str."   <div style=\"\">";
//     $str=$str."    <h5><a href=\"index.php?menuId=9b&prodNo=".$prod_no."\">產品:".$prod_name."<br>單價:".$sug_price."元/$prod_unit</a></h5>";
//     $str=$str."  <form id=\"orderForm\" action=\"index.php\" method=\"get\"><input type=\"text\" value=\"1\" size=\"3\" name=\"number\" style=\"text-align:right;\">&nbsp;<input type=\"hidden\" id=\"menuIds\" name=\"menuIds\" value=\"9a\"><input type=\"hidden\" id=\"prodNo\" name=\"prodNo\" value=\"$prod_no\"><button type=\"submit\" class=\"btn  btn btn-warning\"><span class=\"glyphicon glyphicon-shopping-cart\"></span> 放入購物車</button></form>";
//     $str=$str."   </div>";
//     $str=$str."  </div>";
//     $str=$str." </div>";
//     $str=$str."</div>";
}

echo $str;
?>
</div>
