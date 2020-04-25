<?php
use report\base\Json;
use report\order\Products;
$subid = isset($g['subID'])?$g['subID']:'';
if ($subid!=''){
?>
<style type="text/css"> @import url("<?=WEB_ASSET_URL?>css/jquery.multiselect.css"); </style> 
<script src="<?=WEB_ASSET_URL?>js/jquery.multiselect.js"></script>
<script type="text/javascript">
jQuery(function () {
    jQuery("#selCategoryID").gs_multiselect();
});
</script>
<script>
function checkAD2Select(categoryID){
	//$('#selCategoryID').attr("name" :"selCategoryID");
	var parameterStr = $('#mAd2Product').serialize();
	$.ajax({
    	type: "POST",
        url: defUrl+"ajax/setCategoryProduct.php",
        data: parameterStr,
        dataType:'json',
        success: function(data) {
            if(data['code'] == 1){
	            document.getElementById("mAd2Product").reset();
            	alert('產品分類 '+categoryID+' 已設定完成');
            	//WebTool.webPageOpen(defUrl+"index.php?menuID=22");
            	location.replace(defUrl+"index.php?menuID=22");
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
else{
?>
<script>
function checkAD2Select(){
	//var x = document.getElementById("selCategoryID").value;
	var x = $('#selCategoryID').val();
	if (x!=0){
		$('#subID').val(x);
		//$('#catecoryID').val($("#selCategoryID option:selected").text());
		$('#catecoryID').val(x);
		$('#mAd2Product').submit();
		//document.getElementById("subID").value=x;
		//document.getElementByID("nameID").value = $("#selCategoryID option:selected").text();
		//document.getElementById('mAd2Product').submit();
	}
}
</script>

<?php 
}
?>
<div style="min-height: 700px;">
    <div>
		<div>
			<font style="font-size:30pt">設定產品分類</font>
		</div>
		<div>
			<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
		</div>
		<div>
			<font style="font-size: 12px">HOME>會員中心>管理功能><font style="color:red">設定產品分類</font></font>
		</div>
	</div>
<?php 
if ($subid==''){
    $option='<option value="0">請選擇產品</option>'.PHP_EOL;
    $object = Products::getList1();
    if (!is_null($object)){
        foreach( $object as $row ){
            $typeNo=$row['TYPE_NO'];
            $typeName=$row['TYPE_NAME'];
            $path=$row['path'];
            $pathArray=Json::decode($path);
            $len = count($pathArray);
            $spath='';
            for ($i=1;$i<$len;$i++){
                $spath=$spath.$pathArray[$i]['typeName'].'>';
            }
            $spath=$spath.$pathArray[$len]['typeName'];
            $option=$option.'<option value="'.$typeNo.'">'.$typeName.':'.$spath.'</option>'.PHP_EOL;
        }
        
    }
?>
	<!-- display select list for show some category info -->
	<FORM id="mAd2Product" name="mAd2Product" action='index.php' enctype="multipart/form-data" method="post">
		<input type='hidden' name='menuID' id='menuID' value='22'>
		<input type='hidden' name='subID' id='subID' value=''>
		<input type='hidden' name='catecoryID' id=='catecoryID' value=''>
		<div class="form-group">
  			<label for="sel1">請選擇修改的分類:</label>
  			<select class="form-control" id="selCategoryID" name='selCategoryID'onChange=checkAD2Select()>
    			<?=$option?>
  			</select>
		</div> 
	</FORM>
<?php 
    
}
else{//$subID為所選取的產品編號
    //$catecoryID = isset($g['catecoryID'])?$g['catecoryID']:0;
    $catecoryID = $subid;
    $object = Products::getList1($catecoryID);
    $typeNO='';
    $typeName='';
    if (!is_null($object)){
        $checkTag=0;
        foreach ($object as $row){
            if ($checkTag==0){
                $data1=$row;
                $checkTag=1;
            }
            else if($checkTag==1){
                $data2=$row;
                $checkTag=2;
            }
        }
        $typeNO=$data1[0]['typeNO'];
        $typeName=$data1[0]['typeName'];
        $len=count($data2);
        $arr1=array();
        $arr2=array();
        $selStr='<select id="selCategoryID"  multiple="multiple" style="color:black">'.PHP_EOL;
        foreach( $data2 as $row ){
            $prodNO=$row['prodNO'];
            $prodName=$row['prodName'];
            $tag=$row['TAG'];
            $row1=array(
                'prodNO'=>$prodNO,
                'prodName'=>$prodName,
                'tag'=>$tag,
            );
            if($tag){
                $arr2[]=$row1;
                $selStr=$selStr.'<option value="'.$prodNO.'" selected>'.$prodName.'</option>'.PHP_EOL;                
            }
            else{
                $arr1[]=$row1;
                $selStr=$selStr.'<option value="'.$prodNO.'">'.$prodName.'</option>'.PHP_EOL;
            }
        }
        $selStr=$selStr.'</select>'.PHP_EOL;        
        ?>
	<div>
		<div><!-- display category data <?=$typeName?> -->
			<h1>產品類別:<?=$typeName?></h1>
		</div>
		<div><!-- select list for product belong to this category <?=$typeName?> -->
			<FORM id="mAd2Product" name="mAd2Product" action='index.php' enctype="multipart/form-data" method="post">
				<input type="hidden" name="categoryID" id="categoryID" value=<?=$typeNO?>>
				<?=$selStr?>
				<button type="submit" onclick="checkAD2Select('<?=$typeName?>')" class="btn btn-default">設定</button>
			</FORM>
		</div>
	</div>
<?php     
    }
}
?>
</div>
