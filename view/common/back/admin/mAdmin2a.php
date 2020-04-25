<?php

use report\order\Products;

?>
<style type="text/css"> @import url("<?=WEB_ASSET_URL?>css/bootstrap-datetimepicker.css"); </style> 
<script src="<?=WEB_ASSET_URL?>js/bootstrap-datetimepicker.js"></script>
<script>
function checkAD2zSelect(){
	//$('#selCategoryID').attr("name" :"selCategoryID");
	var i;
	var tag = '#';
	var beCheckValue;
	var tag1=true;
	for (i=0;i<10;i++){
		var bID = tag.concat('selProd',i);
		beCheckValue=$(bID).val();
		if (beCheckValue == "0"){
			tag1=false;
			i=41;
			alert("請設定完十以上個檔案");
		}
		else{
			var cID = tag.concat('prod',i);
			$(cID).val(beCheckValue);	
		}		
	}
	var actb=$('#activeBegin').val();
	var acte=$('#activeEnd').val();
	var stt = new Date(actb);
	stt = stt.getTime();
	var ett = new Date(acte);
	ett = ett.getTime();
	var dt = new Date();
	dtt = dt.getTime();
	if (stt>ett){
		tag1=false;
		alert("開始時間需要小於結束時間");
	}
	else{
		if (dtt>stt){
			tag1=false;
			alert("開始時間需要大於現在時間");
		}
	}
	if (tag1){
		var parameterStr = $('#limitTimeForm').serialize();
		$.ajax({
	    	type: "POST",
	        url: defUrl+"ajax/setLimitTimeProd.php",
	        data: parameterStr,
	        dataType:'json',
	        success: function(data) {
	            if(data['code'] == 1){
		            document.getElementById("limitTimeForm").reset();
	            	alert('限時特賣產品資料 已設定完成');
	            	WebTool.webPageOpen(defUrl+"index.php?menuID=22a");
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
	}		
    return;
}

function checkProdSelect(ID){
	var tag = '#';
	var sID = tag.concat(ID);
	var checkValue = $(sID).val();
	var i;
	var beCheckValue;
	for (i = 0; i < 40; i++) {
		var bID = tag.concat('selProd',i);
		beCheckValue=$(bID).val();
		if ((beCheckValue != "0") && (sID != bID)){
// 			$(bID.concat(" option[value='",checkValue,"']")).remove();
// 			$(bID).trigger("liszt:updated");
			if (checkValue==beCheckValue){
				i=41;
				alert("選取的產品已被使用!!!");
				$(sID).children().each(function(){
				    if ($(this).val()=="0"){
				        //jQuery給法
				        $(this).attr("selected", "true"); //或是給"selected"也可
				    }
				});
				$(sID)[0].selectedIndex = 0;
			}
		}
	}  
}
</script>
<div style="min-height: 700px;">
    <div>
		<div>
			<font style="font-size:30pt">設定限時特賣</font>
		</div>
		<div>
			<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
		</div>
		<div>
			<font style="font-size: 12px">HOME>會員中心>管理功能><font style="color:red">設定限時特賣</font></font>
		</div>
	</div>
	<div>
		<FORM id="limitTimeForm" name="limitTimeForm" action='index.php' enctype="multipart/form-data" method="post">
		
<?php
for ($i=0;$i<40;$i++){
?>
			<input type="hidden" id="prod<?=$i?>" name="prod<?=$i?>" value="0">
<?php
}
?>
			<div class="row" style="color:black;">
				<div class="col-md-5">
					<div style="color:white;">開始時間</div>
					<div>
						<input size="10" type="text" id="activeBegin" name="activeBegin" value="2018-11-1 08:00" readonly class="form_datetime" style="height: 46px;font-size:18pt;">
					</div>				
				</div>
				<div class="col-md-5">
					<div style="color:white;">結束時間</div>
					<div>
						<input size="10" type="text" id="activeEnd" name="activeEnd" value="2018-11-1 17:00" readonly class="form_datetime" style="height: 46px;font-size:18pt;">
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>
		</FROM>
		
		<br>
		<br>
		<div class="row">
<?php
$object = Products::getList2();
$option='<option value="0" selected>請選擇</option>'.PHP_EOL;
if (!is_null($object)){
    foreach( $object as $row ){
        $prodNo=$row['PROD_NO'];
        $prodName=$row['PROD_NAME'];
        $option=$option.'<option value="'.$prodNo.'">'.$prodName.'</option>'.PHP_EOL;
    }
}

for ($i=0;$i<40;$i++){
?>
			<div class="col-md-4">
				<div>產品<?=($i+1)?></div>
				<div>
					<select class="form-control" id="selProd<?=$i?>" name='selProd<?=$i?>' onChange=checkProdSelect("selProd<?=$i?>")>
					<?=$option ?>
					</select>
				</div>
			</div>
			
<?php 
}
?>
			<div class="col-md-4">
				<br>
				<button type="submit" onclick="checkAD2zSelect()" class="btn btn-default">設定</button>
			</div>
		</div>
	
     
    <script type="text/javascript">
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
    </script>            
	</div>
</div>