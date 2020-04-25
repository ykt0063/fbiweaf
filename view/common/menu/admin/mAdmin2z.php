<?php
use report\base\Json;
use report\order\Products;
$subid = isset($g['subID'])?$g['subID']:'';
if ($subid==''){
?>
<script>
function checkAD2Szelect(){
	//var x = document.getElementById("selCategoryID").value;
	var x = $('#selProdID').val();
	if (x!=0){
		$('#subID').val(x);
		//$('#catecoryID').val($("#selCategoryID option:selected").text());
		$('#prodID').val(x);
		$('#mAd2zProduct').submit();
		//document.getElementById("subID").value=x;
		//document.getElementByID("nameID").value = $("#selCategoryID option:selected").text();
		//document.getElementById('mAd2Product').submit();
	}
}
</script>
<?php 
}
else{
    $picArray=array();
    $picNames=array();
    if (isset($_FILES['picFiles']) && !empty($_FILES['picFiles'])) {
        $no_files = count($_FILES["picFiles"]['name']);
        for ($i = 0; $i < $no_files; $i++) {
            if ($_FILES["picFiles"]["error"][$i] > 0) {
                echo "Error: " . $_FILES["picFiles"]["error"][$i] . "<br>";
            } else {
                if (file_exists('assets/images/product' . $_FILES["picFiles"]["name"][$i])) {
                    echo 'File already exists : assets/images/product/' . $_FILES["picFiles"]["name"][$i];
                } else {
                    move_uploaded_file($_FILES["picFiles"]["tmp_name"][$i], 'assets/images/product/' . $_FILES["picFiles"]["name"][$i]);
                    //echo 'File successfully uploaded : uploads/' . $_FILES["files"]["name"][$i] . ' ';
                    $picArray[]='assets/images/product/' . $_FILES["picFiles"]["name"][$i];
                    $picNames[]=$_FILES["picFiles"]["name"][$i];
                }
            }
        }
    }
?>
<script>
function checkAD2zSelect(prodID){
	//$('#selCategoryID').attr("name" :"selCategoryID");
	var parameterStr = $('#productForm').serialize();
	//console.log(parameterStr);
	$.ajax({
    	type: "POST",
        url: defUrl+"ajax/setProductData.php",
        data: parameterStr,
        dataType:'json',
        success: function(data) {
            if(data['code'] == 1){
	            document.getElementById("mAd2zProduct").reset();
            	alert('產品資料 '+prodID+' 已設定完成');
            	WebTool.webPageOpen(defUrl+"index.php?menuID=22z");
            	//location.replace(defUrl+"index.php?menuID=22z");
            }else{
				alert(data['desc']);
				//alert('影像檔案不正確,請重新上傳');
            }
        },
        error:function(xhr, ajaxOptions, thrownError){
            alert(thrownError);
 		}
    });
    return;
}
</script>
<?php 
}
?>
<div style="min-height: 700px;">
    <div>
		<div>
			<font style="font-size:30pt">設定產品資料</font>
		</div>
		<div>
			<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
		</div>
		<div>
			<font style="font-size: 12px">HOME>會員中心>管理功能><font style="color:red">設定產品資料</font></font>
		</div>
	</div>

<?php 
if ($subid==''){
    $option='<option value="0">請選擇產品</option>'.PHP_EOL;
    $object = Products::getList2();
    if (!is_null($object)){
        foreach( $object as $row ){
            $prodNo=$row['PROD_NO'];
            $prodName=$row['PROD_NAME'];
            $option=$option.'<option value="'.$prodNo.'">'.$prodName.'</option>'.PHP_EOL;
        }
    }
?>
	<!-- display select list for show some category info -->
	<FORM id="mAd2zProduct" name="mAd2zProduct" action='index.php' enctype="multipart/form-data" method="post">
		<input type='hidden' name='menuID' id='menuID' value='22z'>
		<input type='hidden' name='subID' id='subID' value=''>
		<input type='hidden' name='prodID' id=='catecoryID' value=''>
		<div class="form-group">
  			<label for="sel1">請選擇產品:</label>
  			<select class="form-control" id="selProdID" name='selProdID'>
    			<?=$option?>
  			</select>
		</div> 
		<div class="form-group">
    		<label for="files[]>">選擇產品用照片</label>
    		<input type="file" id="multiFiles" name="picFiles[]" multiple="multiple"/>
  		</div>
  		 <button id="upload" onClick="checkAD2Szelect()" class="btn btn-default">確認</button>
	</FORM>
<?php 
}
else{
    $prodID = $subid;
    $object = Products::getList2($prodID);
    $ct=0;
    $prod_no='';
    $prod_name='';
    $sug_price='';
    $prod_unit='';
    $mb_price='';
    foreach( $object as $row ){
        if ($ct==0){
            $row0=$row[0];
            $prod_no=$row0['PROD_NO'];
            $prod_name=$row0['PROD_NAME'];
            $sug_price=$row0['SUG_PRICE'];
            $prod_unit=$row0['PROD_UNIT'];
            $pv=$row0['PV'];
            $ps=$row0['PS'];
            $barCode=$row0['BARCODE'];
            $mb_price=$row0['MB_PRICE'];
            $netPrice=$row0['Net_PRICE'];
            $pic=$row0['pic'];
            $pics=array();
            $pics[0]=$row0['pic1'];
            $pics[1]=$row0['pic2'];
            $pics[2]=$row0['pic3'];
            $pics[3]=$row0['pic4'];
            $pics[4]=$row0['pic5'];
            $note=$row0['NOTE'];
            $spec="";
            $fieldNumber=$row0['FIELD_NUMBER'];
            $statusCode=$row0['statusCode'];
            switch ($statusCode){
                case 3:
                    break;
                case 2:
                    break;
                case 1:
                    break;
                case 0:
                default:
                    $statusCode=0;
                    break;
            }
            //$mb_price=$sug_price;
            $ct=$ct+1;
        }
        else{
            if ($ct==1){
                foreach ($row as $key=> $data){
                    $spec=$spec.$data['FIELD_NAME'].":".$data['FIELD_VALUE'].PHP_EOL;
                }
//                 for ($i=0;$i<$fieldNumber;$i++){
//                     $spec=$spec.$row[$i]['FIELD_NAME'].":".$row[$i]['FIELD_VALUE'].PHP_EOL;
//                 }
                $ct=$ct+1;
            }
        }
    }
    //for show and setting product detail data
?>
	<div class="table-responsive" style="overflow: hidden">
		<form id="productForm" action='index.php' enctype="multipart/form-data" method="post">
			<input type="hidden" id="prodID" name="prodID" value="<?=$prod_no?>">
			<div>產品名稱:<?=$prod_name?></div>
			<div>產品售價:<?=$sug_price?></div>
			<div>PV值:<?=$pv?></div>
			<div class="form-group">
  				<label for="mbPrice">會員售價:</label>
  				<input type="number" class="form-control" id="mbPrice" name="mbPrice" value="<?=$mb_price?>">
			</div>
			<div class="form-group">
  				<label for="netPrice">網路售價:</label>
  				<input type="number" class="form-control" id="netPrice" name="netPrice" value="<?=$netPrice?>">
			</div>
			<div class="form-group">
  				<label for="statusCode">狀態:0:銷售中,1:預售中,2:銷售完畢3:即期品</label>
  				<input type="number" class="form-control" id="statusCode" name="statusCode" min="0" max="3" value="<?=$statusCode?>">
			</div>

			<br>
<?php

    if (count($picArray)==0){
?>
			<div>無上傳產照片</div>
<?php 
    }
    else{
        for ($i=0;$i<count($picArray);$i++){
?>
			<div class="row">
				<div class="col-md-3">檔案-<?=$picNames[$i]?></div>
				<div class="col-md-8"><img src="<?=$picArray[$i]?>" name="pic<?=$i?>" class="img-responsive"></div>
			</div>
			<br>
<?php 
        }
?>	
		   <br>
		   <div cloass="row">
		   		<div class="col-md-3">請選擇主照片</div>
		   		<div class="col-md-9">
		   			<div><img src="<?=$pic?>" class="img-responsive"></div>
		   			<div class="form-check">
	  					<input class="form-check-input" type="radio" name="pic" id="pic" value="0" checked>
	  					<label class="form-check-label" for="pic">
		  					無
	  					</label>
					</div>
<?php 
        for($i=0;$i<count($picArray);$i++){
?>
			   		<div class="form-check">
	  					<input class="form-check-input" type="radio" name="pic" id="pic" value="<?=$picArray[$i]?>">
	  					<label class="form-check-label" for="pic">
	  					  <?=$picNames[$i]?>
  						</label>
					</div>
<?php 
        }
?>
					<br>
		   		</div>
		   		
		   </div>
		   <br>
<?php 
        for($j=1;$j<=5;$j++){
?>
		   <div cloass="row">
		   		<div class="col-md-3">請選擇照片<?=$j?></div>
		   		<div class="col-md-9">
<?php 
            if($pics[($j-1)]!=''){
?>
		   			<div><img src="<?=$pics[($j-1)]?>" name="pic<?=$j?>" class="img-responsive"></div>
<?php 
            }
            else{
?>
		   			<div>無照片</div>
<?php 
            }
?>
			   		<div class="form-check">
	  					<input class="form-check-input" type="radio" name="pic<?=$j?>" id="pic<?=$j?>" value="0" checked>
	  					<label class="form-check-label" for="pic<?=$j?>">
	  					無
	  					</label>
					</div>
		   		
<?php 
            for($i=0;$i<count($picArray);$i++){
?>
			   		<div class="form-check">
	  					<input class="form-check-input" type="radio" name="pic<?=$j?>" id="pic<?=$j?>" value="<?=$picArray[$i]?>">
	  					<label class="form-check-label" for="pic<?=$j?>">
	  					  <?=$picNames[$i]?>
	  					</label>
					</div>
<?php 
            }
?>
				<br>
				</div>
		   </div>
		   <br>
<?php
        }
?>
<?php 
    }
?>
			<div class="form-group">
  				<label for="note">產品說明:</label>
  				<textarea class="form-control" id="note"  name="note" rows="5" value=<?=$note?>></textarea>
			</div>
			<div class="form-group">
  				<label for="spec">規格說明:欄位名稱:欄位值(跳行-ENTER)</label>
  				<textarea class="form-control" id="spec"  name="spec" rows="5" value=<?=$spec?>></textarea>
			</div>
			<div>
				<button type="submit" onclick="checkAD2zSelect('<?=$prod_name?>')" class="btn btn-default">設定</button>
			</div>
		</form>
	</div>
<?php 
}
?>
</div>