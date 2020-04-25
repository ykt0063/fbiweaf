<?php
use report\order\Products;
use report\user\product;
$productID = isset($g['productID'])?$g['productID']:'AA001';
$result=array();
$result = Products::GetProductDetail($productID);
$prod_no='';
$prod_name='';
$sug_price='';
$prod_unit='';
$mb_price='';
$spec=array();
$row0=$result;
$prod_no=$row0['PROD_NO'];
$prod_name=$row0['PROD_NAME'];
$sug_price=$row0['SUG_PRICE'];
$comp_price=$row0['COMP_PRICE'];
$prod_unit=$row0['PROD_UNIT'];
$pv=$row0['PV'];
$ps=$row0['PS'];
$barCode=$row0['BARCODE'];
$mb_price=$row0['MB_PRICE'];
$netPrice=$row0['COMP_PRICE'];
$pic=$row0['pic'];
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
			<font style="font-size: 12px">HOME>商品介紹><font style="color:red"><?=$prod_name?></font></font>
		</div>
	</div>
	<div class="table-responsive" style="overflow: hidden">
		<div class="row">
			<div class="col-md-5 col-md-offset-1">
				<img src="<?=$pic?>" style="height:360px;width:360px" class="img-responsive">
			</div>
			<div class="col-md-5">
				<img src="<?=$statusStr?>">
				<div styee="font-size: 20pt"><?=$prod_no?></div>
				<div styee="font-size: 20pt"><?=$prod_name?></div>
				<div styee="font-size: 20pt">售價:<?=$comp_price?></div>
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
						<input type="hidden" id="price" name="price" value="<?=$sug_price?>">
						<input type="hidden" id="unit" name="unit" value="<?=$prod_unit?>">
						<input type="hidden" id="productName" name="productName" value="<?=$prod_name?>">
						<input type="hidden" id="pv" name="pv" value="<?=$pv?>">
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
					    <a href="javascript:void(0)" onClick="handlerAddProduct()">
						    <button type="button" class="btn btn-danger">&nbsp;&nbsp;&nbsp;加入購物車+&nbsp;&nbsp;&nbsp;</button>
						</a>
  					</form>
				</div>
			</div>
		</div>
		<br><br>
		<div id="prodType">
			<ul class="nav nav-tabs" style="background-color:#D2B58C">
	    		<li class="active"><a data-toggle="tab" href="#home">商品規格</a></li>
<!-- 	    		<li><a data-toggle="tab" href="#menu1">商品介紹</a></li> -->
	    		<li><a data-toggle="tab" href="#menu2">付款方式與手續費說明</a></li>
	    		<li><a data-toggle="tab" href="#menu3">購物說明</a></li>
	  		</ul>
	  		<br>
	  		<div class="tab-content">
	    		<div id="home" class="tab-pane fade in active">
	    			<?php	    			
// 	    			for ($i=0;$i<count($spec);$i++){
// 	    			    $j= $i %2;
// 	    			    if ($j==0){
// 	    			        $style="style=\"background-color:pink;color:black\"";
// 	    			    }
// 	    			    else{
// 	    			        $style='';
// 	    			    }
// 	    			    $tmpArray=explode("\n", $spec[$i][1]);
// 	    			    if (count($tmpArray)==0){
// 	    			        $tmpArray=explode("\r\n", $spec[i][1]);
// 	    			    }
// 	    			    $tmpStr='';
// 	    			    for ($j=0;$j<count($tmpArray);$j++){
// 	    			        $tmpStr=$tmpStr.'<P>'.$tmpArray[$j].'</P>'.PHP_EOL;
// 	    			    }
// ?>

 <?php 	    			    
// 	    			}
// 	    			?>
	    		</div>
	    		<div id="menu1" class="tab-pane fade">
	    		<?php
// 	    		for($i=0;$i<5;$i++){
// 	    		    if($pics[$i]!=''){
// 	    		?>
 	    		        <div> 
		    		        <img src="<?php //$pics[$i]?>" class="img-responsive">
	    		        </div>
	    		        <br>
	    		<?php
// 	    		    }
// 	    		}
	    		?>
	    		</div>
	    		<div id="menu2" class="tab-pane fade">
	    		  <div>
	      				<img src="<?=WEB_ASSET_URL?>images/main/prodFee.png" class="img-responsive">
	      			</div>
	      		</div>
	    		<div id="menu3" class="tab-pane fade">
	      		  <div style="background-color: white;color:black;padding:10px">
	      		  	<p>退換貨須知：</p>
				  <p>商品到貨享七天猶豫期之權益（注意！猶豫期非試用期），辦理退貨商品必須是全新狀態且包裝完整，否則將會影響退貨權限。各類商品退換貨限制說明</p>
				  <p>個人衛生用品除商品本身有瑕疵外，未拆封商品仍享有十天猶豫期之退貨權利。但已拆封 (如剪標、下水等情形…)，依據《通訊交易解除權合理例外情事適用準則》，本公司無法接受退換貨。</p>
				  <p>※個人衛生用品項目：內衣褲(含隱形胸罩、胸扥、胸貼、透明肩帶、水餃墊/美胸墊、襯裙)、塑身衣(含馬甲、束褲、束腿、腰夾、內搭)、泳裝、襪子、紙尿褲。</p>
				  <br>
				  <p>運送服務：</p>
				  <p>我們所提供的產品配送區域範圍目前僅限台灣本島。</p>
				  <p>商品之實際配貨日期、退換貨日期，依我們向您另行通知之內容為準。</p>
				  <p>針對大型商品(包括：大型家電、家具床墊、健身按摩器材、車類...等)，我們將於完成收款確認後，一天內〈不含例假日〉將會有專人與您確認相關配送細節等的聯繫。偏遠地區、樓層費及其它加價費用，皆由廠商於約定配送時一併告知，廠商將保留出貨與否的權利。</p>
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