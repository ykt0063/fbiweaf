<?php
use report\order\Products;
use report\user\Session;
use report\user\product;
$productID = isset($g['productID'])?$g['productID']:'AA001';
$result=array();
$result = Products::GetProductDetail($productID);
$prodPic = Session::get('prodPic');
$prod_no='';
$prod_name='';
$sug_price='';
$prod_unit='';
$mb_price='';
$spec=array();
$row0=$result;
$prod_no=$row0['PROD_NO'];
$tmpProdSPath=$prod_no.".jpg";
$subDir=substr($prod_no,0,2);
if (in_array($tmpProdSPath,$prodPic[2]['filename'])){
    $prodSPath=WEB_ASSET_URL.'images/product/p3/'.$subDir.'/'.$prod_no.'.png';
}
else{
    $prodSPath=WEB_ASSET_URL.'images/product/554643.jpg';
}
if (in_array($tmpProdSPath,$prodPic[3]['filename'])){
    $prodSpecPath=WEB_ASSET_URL.'images/product/p4/'.$subDir.'/'.$prod_no.'.png';
    $prodSpecTag=true;
}
else{
    $prodSpecPath=WEB_ASSET_URL.'images/product/554643.jpg';
    $prodSpecTag=false;
}
$prod_name=$row0['PROD_NAME'];
$prod_type=substr($prod_no,0,2);
$sug_price=$row0['SUG_PRICE'];
$comp_price=$row0['COMP_PRICE'];
$prod_unit=$row0['PROD_UNIT'];
$pv=$row0['PV'];
$ps=$row0['PS'];
$barCode=$row0['BARCODE'];
$mb_price=$row0['MB_PRICE'];
$netPrice=$row0['COMP_PRICE'];
$pic=$row0['pic'];
$exch_points=$row0['EXCH_POINTS'];
//$pic=WEB_ASSET_URL.'images/main/limit2.png';
$pic=product::getProductImagePath($productID);
$pics=array();
$pics[0]='';
$pics[1]=$row0['pic2'];
$pics[2]='';
$pics[3]='';
$pics[4]='';
$note='';
$notes=explode("\n", $note);
//$fieldNumber=$row0['FIELD_NUMBER'];
$statusCode=$row0['chk'];
switch ($statusCode){
    case 'N':
        $statusStr='';
        break;
    default:
        $statusStr='';
        break;
}
?>
<script>
function handlerAddProduct(){
	var addNumber = $.trim($('#addNumber').val());
	if (isNaN(addNumber)){
		alert('請選擇正確數量');
	}
	else{
		document.getElementById('menuForm1').submit();
	}
};
</script>
<div style="min-height: 700px;">
    <div>
		<div>
			<font style="font-size:30pt">商品介紹</font>
		</div>
		<div>
			<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
		</div>
		<div>
			<font style="font-size: 12px"><a href="#" onclick="handler0('1'); return false;" style="text-decoration:none;">HOME</a>><a href="#" onclick="handlerProd('<?=$prod_type?>'); return false;" style="text-decoration:none;" >商品介紹</a>><font style="color:red"><?=$prod_name?></font></font>
		</div>
	</div>
	<div class="table-responsive" style="overflow: hidden">
		<div class="row">
			<div class="col-md-5 col-md-offset-1">
				<div id="zoomTag">
					<img class="zoom" src="<?=$pic?>" data-big="<?=$pic?>" style="height:360px;width:360px"/>
				</div>
				
			</div>
			<div class="col-md-5">
				<img src="<?=$statusStr?>">
				<!--
				    <div styee="font-size: 20pt"><?=$prod_no?></div> 
				 -->
				<div styee="font-size: 20pt"><?=$prod_name?></div>
				<div styee="font-size: 20pt">會員價:<?=$mb_price?></div>
				<div>
					<?php
// 					for($i=0;$i<count($notes);$i++){
// 					    echo $notes[$i].PHP_EOL;
// 					}
					?>
				</div>
				<div>
					<form id="menuForm1" action='index.php' enctype="multipart/form-data" method="post">
						<input type="hidden" id="menuID" name="menuID" value="0">
						<input type="hidden" id="mainID" name="mainID" value="1">
						<input type="hidden" id="prodID" name="prodID" value="a">
						<input type="hidden" id="productID" name="productID" value="<?=$prod_no?>">
						<input type="hidden" id="price" name="price" value="<?=$mb_price?>">
						<input type="hidden" id="exch_points" name="exch_points" value="<?=$exch_points?>">
						<input type="hidden" id="unit" name="unit" value="<?=$prod_unit?>">
						<input type="hidden" id="productName" name="productName" value="<?=$prod_name?>">
						<input type="hidden" id="pv" name="pv" value="<?=$pv?>">
						<input type="hidden" id="exch_points" name="exch_points" value="<?=$exch_points?>">
    					<div class="form-group">
      						<select class="form-control" id="addNumber" name="addNumber">
        						<option>1</option>
        						<option>2</option>
        						<option>3</option>
        						<option>4</option>
        						<option>5</option>
        						<option>6</option>
        						<option>7</option>
        						<option>8</option>
        						<option>9</option>
        						<option>10</option>
        						<option>11</option>
        						<option>12</option>
        						<option>13</option>
        						<option>14</option>
        						<option>15</option>
      						</select>
					    </div>
					    <div>
					    	<div class="row">
					    		<div class="col-md-4">
					    			<a href="javascript:void(0)" onClick="handlerAddProduct()">
						    			<button type="button" class="btn btn-danger">&nbsp;&nbsp;&nbsp;加入購物車+&nbsp;&nbsp;&nbsp;</button>
									</a>
					    		</div>
					    		<div class="col-md-4">
					    			<a href="#" <?=$scLinkTag?> style="text-decoration:none;">
						    			<button type="button" class="btn btn-danger">&nbsp;&nbsp;&nbsp;進入購物車+&nbsp;&nbsp;&nbsp;</button>
									</a>
					    		</div>
					    		<div class="col-md-4">
				    				<a href="javascript:void(0)" onClick="handler0('1')">
						    			<button type="button" class="btn btn-danger">&nbsp;&nbsp;&nbsp;繼續購物+&nbsp;&nbsp;&nbsp;</button>
									</a>
					    		</div>
					    	</div>
					    </div>
  					</form>
				</div>
			</div>
		</div>
		<br><br>		
<!-- 		<div id="prodType"> -->
<!-- 			<div> 
			<img src="assets/images/product/554643.jpg" style="width:100%;vertical-align: top;">
 		</div> -->
<!-- 		</div> -->
			<div id="prodType">
            	<ul class="nav nav-tabs" style="background-color:#D2B58C">
                	<li class="active"><a data-toggle="tab" href="#home">商品特性</a></li>
<!--                <li><a data-toggle="tab" href="#menu1">商品介紹</a></li> -->
                    <li><a data-toggle="tab" href="#menu2">商品規格</a></li>
                    <li><a data-toggle="tab" href="#menu3">購物說明</a></li>
                </ul>
                <br>
                <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                	<div> 
						<img src="<?=$prodSPath?>" class="img-responsive">
 					</div>
                </div>
                <div id="menu1" class="tab-pane fade">
                	
                </div>
                <div id="menu2" class="tab-pane fade">
 	            	<div>
<?php 
if ($prodSpecTag){
?>
						<img src="<?=$prodSpecPath?>" class="img-responsive">
<?php 
}
?>
						<!-- 
                    	<img src="<?=WEB_ASSET_URL?>images/main/prodFee.png" class="img-responsive">
                    	 -->
                    </div>
                </div>
                <div id="menu3" class="tab-pane fade">
                	<div style="background-color: white;color:black;padding:10px">
                    	<p>退換貨須知：</p>
                        <p>商品到貨享七天猶豫期之權益（注意！猶豫期非試用期），辦理退貨商品必須是全新狀態且包裝完整，否則將會影響退貨權限。</p>
                        <br>
                        <p>運送服務：</p>
                        <p>我們所提供的產品配送區域範圍目前僅限台灣本島。</p>
                        <p>商品之實際配貨日期、退換貨日期，依我們向您另行通知之內容為準。</p>
                        <br>
                        <p>售後服務：</p>
                        <p>如您收到商品，請依正常程序儘速檢查商品，若商品發生新品瑕疵之情形，您可申請更換新品，請直接點選聯絡我們。</p>
                        <p>若您對於購買流程、付款方式、退貨及商品運送方式有疑問，你可直接點選會員中心。</p>
                        <br>
                        <p>特別說明：</p>
                        <p>本公司對於所販售具遞延性之商品或服務，消費者權益均受保障。如因合作廠商無法提供商品或服務，請與本公司聯繫辦理退貨或換成等值商品</p>
                    </div>
                </div>
            </div>
        </div>                
	</div>
</div>
<!--mlens 設定-->
<script>
//<![CDATA[
$(".zoom").each(function() {
var $this = $(this);
$this.mlens({
imgSrc: $this.attr("data-big"),
lensShape: "circle", // 放大鏡形狀 circle(圓形), square(方形)
lensSize: ["120%", "120%"], // 放大鏡長寬 (可使用 px 或百分比 %)
borderSize: 3, // 放大鏡邊框寬度 (px)
borderColor: "#fff", // 放大鏡邊框顏色色碼
borderRadius: 0, // 如果放大鏡為方形 設定圓角程度
overlayAdapt: true,
<?php 
if ($pic==WEB_ASSET_URL.'images/main/limit2.png'){
?>
zoomLevel: 2,
<?php 
}
else{
?>
zoomLevel: 0.8,
<?php 
}
?>
responsive: true // 圖片是否自適應
});
}).parent().css("position", "relative");
var x = $( window ).width();
if (((x<757)||(isSmartPhone()))){
	$('#zoomTag').html("<img src='<?=$pic?>' style='height:360px;width:360px' class='img-responsive'>");
}
//]]>
</script>
