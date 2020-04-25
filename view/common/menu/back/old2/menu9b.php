<?php
use report\user\Session;
use report\order\Products;
use report\tool\ShoppingCart;
$account='';
$num=0;
$result=array();
$account=SESSION::get('account');
$prodNo=isset($g['prodNo'])?$g['prodNo']:'';
if (null!=$account && $prodNo!=''){
    $result = Products::GetProductDetail($prodNo);
}
$opCode=isset($g['opCode'])?$g['opCode']:'';
if ($opCode=='add2Cart'){
    $prodNo=isset($g['prodNo'])?$g['prodNo']:'';
    $prodName=isset($g['prodName'])?$g['prodName']:'';
    $price=isset($g['price'])?$g['price']:'';
    $number=isset($g['number'])?$g['number']:'';
    $pv=isset($g['pv'])?$g['pv']:'';
    $unit=isset($g['unit'])?$g['unit']:'';
    ShoppingCart::add2Cart($prodNo, $price, $number, $pv,$prodName,$unit);
}
$cart=ShoppingCart::getCartDataList();
$num=$cart['cartNo'];
 for($i=0;$i<$cart['cartNo'];$i++){
     $ci=$cart[$i];
     //echo "card[".$i."]=['".$ci['prodNo']."','".$ci['prodName']."','".$ci['price']."','".$ci['number']."','".$ci['unit']."','".$ci['pv']."']<br>";
 }
$str="";
?>
<br>
<form action="index.php" method="get" id="orderForm">
<div id="shop_main" class="row">
<?php
foreach( $result as $row ){
    $prod_no=$row['PROD_NO'];
    $prod_name=$row['PROD_NAME'];
    $sug_price=$row['SUG_PRICE'];
    $prod_unit=$row['PROD_UNIT'];
    $pv=$row['PV'];
    $ps=$row['PS'];
    //$str= "opCode=add2Cart&prodNo=".$prod_no."&prodName=".$prod_name."&price=".$sug_price."&unit=".$prod_unit."&pv=".$pv."&number=1";
    if ($ps==''){
        $homepage = file_get_contents('http://www.randomtext.me/api/lorem/ul-3/5-10/');
        $obj=json_decode($homepage);
        $ps=$obj->{'text_out'};
    }
    $barcode=$row['BARCODE'];
    if ($barcode=='')
        $barcode="<img src=\"http://bwipjs-api.metafloor.com/?bcid=code128&text=$prod_no\">";
}
?>
	<div class="col-md-4 text-center">
		<div class="">
			<br>
			<img src="<?php echo WEB_ASSET_URL?>images/<?php echo $prod_no?>.jpg" alt="<?php echo $prod_name?>">
		</div>
	</div>
	<div class="col-md-4 text-center">
		<div class="">
			<div class="caption">
				<div class="">
					<H4>
					<table align="center" class="tb" border='1'  style="border:3px #FFD382 dashed;" >
						<tr>
							<td>產品</td>
							<td><?php echo $prod_name?></td>
						</tr>
						<tr>
							<td>單價</td>
							<td><?php echo $sug_price."元/".$prod_unit?></td>
						</tr>
						<tr>
							<td>PV</td>
							<td><?php echo $pv?></td>
						</tr>
						<tr>
							<td>規格</td>
							<td align="left"><?php echo $ps?></td>
						</tr>
						<tr>
							<td>BARCODE</td>
							<td><?php echo $barcode?></td>
						</tr>
						<tr>
							<td>採購數量</td>
							<td><input type="text" name="number" value="1" size="3" style="text-align:right;"><?php echo $prod_unit?></td>
						</tr>
					</table>
					</H4>
				</div>
			</div>
		</div>		
	</div>
		<div class="col-md-4 text-center">
		<div class="">
			<br>
			<div>
				<button type="submit" class="btn btn-lg btn-warning">
					<span class="glyphicon glyphicon-shopping-cart"></span> 放入購物車
				</button>			
			</div>
			<br>
			<div>
				<a href="index.php?menuId=9c" class="btn btn-lg btn-danger">
					<span class="glyphicon glyphicon-play"></span> 直接來結帳
				</a>
			</div>
			<br>
			<div>
				<a href="index.php?menuId=9a" class="btn btn-lg btn-info">
					<span class="glyphicon glyphicon-list-alt"></span> 回產品清單
				</a>
			</div>
<?php 
if ($num>0){
?>
			<br>
				
			</div>
			<h4>
			<table align="center">
			<tr align="left"><td>共選取<?php echo $num?>個產品</td></tr>
<?php 
    for ($i=0;$i<$num;$i++){
        $ci = $cart[$i];
        $prodName=$ci['prodName'];
        $number=$ci['number'];
        $unit=$ci['unit'];
?>
			<tr align="left"><td><li><?php echo $prodName."(".$number.$unit.")"?></li></td></tr>
<?php 
    }
}
?>
			</table>
			</h4>
		</div>
	</div>
</div>
<input type="hidden" name="opCode" value="add2Cart">
<input type="hidden" name="prodNo" value=<?php echo $prod_no?>>
<input type="hidden" name="prodName" value=<?php echo $prod_name?>>
<input type="hidden" name="price" value=<?php echo $sug_price?>>
<input type="hidden" name="pv" value=<?php echo $pv?>>
<input type="hidden" name="unit" value=<?php echo $prod_unit?>>
<input type="hidden" id="menuIds" name="menuIds" value="9b">
</form>