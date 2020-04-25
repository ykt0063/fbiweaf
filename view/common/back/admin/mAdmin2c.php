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
	var bValue;
	var dValue;
	var tag1=true;
	var aID;
	var bID;
	var aValue;
	var dID;
	var cID;
	for (i=0;i<40;i++){
		aID= tag.concat('selDisc',i);
		bID= tag.concat('disc',i);
		aValue=$(aID).val();
		$(bID).val(aValue);
		aID= tag.concat('selProd',i);
		bID= tag.concat('prod',i);
		aValue=$(aID).val();
		$(bID).val(aValue);
	}
	for (i=0;i<10;i++){
		bID = tag.concat('selProd',i);
		dID= tag.concat('selDisc',i);
		bValue=$(bID).val();
		dValue=$(dID).val();
		if (bValue == '0'){
			tag1=false;
			i=41;
			alert("請設定完十以上個檔案");
		}
		else{
			if (dValue=='0'){
				tag1=false;
				i=41;
				aValue="請設定產品";
				alert(aValue.concat(i,"的折扣"));
			}
// 			else{
// 				cID = tag.concat('prod',i);
// 				$(cID).val(bValue);	
// 			}
		}		
	}
	var month=$('#selMonth').val();
	if (month=="0"){
		tag1=false;
		alert("請設定月份");
	}
	if (tag1){
		var parameterStr = $('#specForm').serialize();
		$.ajax({
	    	type: "POST",
	        url: defUrl+"ajax/setSpecProd.php",
	        data: parameterStr,
	        dataType:'json',
	        success: function(data) {
	            if(data['code'] == 1){
		            document.getElementById("specForm").reset();
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
			<font style="font-size:30pt">設定本月特惠</font>
		</div>
		<div>
			<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
		</div>
		<div>
			<font style="font-size: 12px">HOME>會員中心>管理功能><font style="color:red">設定本月特惠</font></font>
		</div>
	</div>
	<div>
		<FORM id="specForm" name="specForm" action='index.php' enctype="multipart/form-data" method="post">
		
<?php
for ($i=0;$i<40;$i++){
?>
			<input type="hidden" id="prod<?=$i?>" name="prod<?=$i?>" value="0">
			<input type="hidden" id="disc<?=$i?>" name="disc<?=$i?>" value="0">
<?php
}
$thisM=date('Y-m');
$thisB=date('Y-m-01 00:00:00');
$thisE=date('Y-m-t 23:59:59');
$nextM=date('Y-m', strtotime('+1 month'));
$nextB=date('Y-m-01 00:00:00', strtotime('+1 month'));
$nextE=date('Y-m-t 23:59:59', strtotime('+1 month'));
?>
			<div>
				<select class="form-control" id="selMonth" name='selMonth'>
					<option value="0" selected>請選擇月份</option>
					<option value="<?=$thisB.':'.$thisE?>"><?=$thisM?></option>
					<option value="<?=$nextB.':'.$nextE?>"><?=$nextM?></option>'					
				</select>
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
				<div>折扣</div>
				<div>
					<select class="form-control" id="selDisc<?=$i?>" name='selDisc<?=$i?>')>
						<option value="0" selected>請選擇折扣數</option>
						<option value="95">95折</option>
						<option value="90">9折</option>
						<option value="85">85折</option>
						<option value="80">8折</option>
						<option value="75">75折</option>
						<option value="70">7折</option>
						<option value="65">65折</option>
						<option value="60">6折</option>
						<option value="55">55折</option>
					</select>
				</div>
				<br>
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