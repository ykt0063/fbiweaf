<?php
use report\user\Session;
use report\tool\RegisterTool;
$transCode=Session::get('transCode');
$totaExch_points=Session::get('totaExch_points');
$totalCost=Session::get('totalCost');
if (is_null($totaExch_points)){
    $totaExch_points=0;
}
/*
else{
    $eRate=Session::get('eRate');
    //$eRate=100;
    $tmpEP = $totalCost*$eRate/100;
    if ($tmpEP<$totaExch_points){
        $totaExch_points=$tmpEP;
    }
}
*/
// $tFee=Session::get('tFee');
if ($transCode<>'1'){
//     $storeID=$g['storeID'];
//     $storeName=$g['storeName'];
//     $stroeAddr=$g['stroeAddr'];
    $storeID='';
    $storeName='';
    $stroeAddr='';
    $obj=array('storeID'=>$storeID,'storeName'=>$storeName,'stroeAddr'=>$stroeAddr);
    Session::save($obj);
}
if (Session::get('tmpMBNO')!=FALSE){
    $tag=0;
    $mbno=Session::get('tmpMBNO');
}
else{
    if(Session::get('account')!=FALSE){
        $tag=1;
        $mbno=Session::get('account');
    }
    else{
        $tag=-1;
    }
}
$eff=Session::get('eff');
$eRate=Session::get('eRate');
$tmpEP = ($totalCost-$tFee)*$eRate/100;
if ($tmpEP<$eff){
    $eff=$tmpEP;
}
if ($tag>-1){
    $object=RegisterTool::getRegistData($tag, $mbno);
    $code=$object['code'];
    if ($code==0){
        $data=$object['data'];
        $name=$data['name'];
        $tel=$data['tel'];
        $mtel=$data['mtel'];
        $addr=$data['addr'];
?>
<script>
$(document).ready(function() {
    $('input[type=radio][name=invoiceType]').change(function() {
        if (this.value == '2') {
        	var str="";
            //var str="<div class=\"col-md-5\">\n";
            //str=str+"	<div class=\"form-group\">\n";
            //str=str+"		<label for=\"invoiceName\">受買人:</label>\n";
            str=str+"		<input type=\"hidden\" class=\"form-control\" id=\"invoiceName\" name=\"invoiceName\">\n";
            //str=str+"	</div>\n";
            //str=str+"</div>\n";
            //str=str+"<div class=\"col-md-1\"></div>\n";
            str=str+"<div class=\"col-md-5\">\n";
            str=str+"	<div class=\"form-group\">";
            str=str+"		<label for=\"invoiceNumber\">統一編號:</label>\n";
            str=str+"		<input type=\"text\" class=\"form-control\" id=\"invoiceNumber\" name=\"invoiceNumber\">\n";
            str=str+"	</div>\n";
            str=str+"</div>\n";
            str=str+"<div class=\"col-md-5\">\n";
            str=str+"	<div class=\"form-group\">\n";
            str=str+"		<label for=\"invoiceTitle\">發票抬頭:</label>\n";
            str=str+"		<input type=\"text\" class=\"form-control\" id=\"invoiceTitle\" name=\"invoiceTitle\">\n";
            str=str+"	</div>\n";
            str=str+"</div>\n";
            $('#ivt3').html(str);
        }
        else{
            $('#ivt3').html("<br>\n");
        }
    });
    $('input[type=radio][name=payMethod]').change(function() {
        if (this.value == '5') {
            $('#payEP').attr('disabled',false);
<?php
if ($transCode!=1){
?>
            $('#payEPA').attr('disabled',true);
<?php
}
?>
        }
        else if (this.value == '7'){
<?php
if ($transCode!=1){
?>
        	$('#payEPA').attr('disabled',false);
<?php
}
?>
        	$('#payEP').attr('disabled',true);
        }    
        else{
            $('#payEP').attr('disabled',true);
<?php
if ($transCode!=1){
?>
            $('#payEPA').attr('disabled',true);
<?php
}
?>
        }
    });
    $('#payEP').change(function(){
    	var payEP = Number($.trim($('#payEP').val()));
	if (payEP><?=$eff?>){
            payEP=<?=$eff?>;
            $('#payEP').val(payEP);
        }
    	if (payEP<= <?=($totalCost-$tFee)?>){
        	var payEP1= <?=$totalCost?> - payEP;
        	var str = "&nbsp;信用卡支付:"+payEP1;
        	$('#payEP1').html(str);
    	}
    	else{
    		$('#payEP').val(<?=($totalCost-$tFee)?>);
    		$('#payEP1').html("&nbsp;信用卡支付:<?=$tFee?>");
    	}
    });
<?php 
if ($transCode!=1){
?>
    $('#payEPA').change(function(){
    	var payEPA = Number($.trim($('#payEPA').val()));
        if (payEPA><?=$eff?>){
            payEPA=<?=$eff?>;
            $('#payEPA').val(payEPA);
        }
    	if (payEPA< <?=($totalCost-$tFee)?>){
        	var payEP1= <?=$totalCost?> - payEPA;
        	var str = "&nbsp;貨到付款:"+payEP1;
        	$('#payEPA1').html(str);
    	}
    	else{
    		$('#payEPA').val(<?=($totalCost-$tFee)?>);
    		$('#payEPA1').html("&nbsp;貨到付款:<?=$tFee?>");
    	}
    });
<?php 
}
?>
});
function toPay(){
	var toName = $.trim($('#toName').val());
	var toTel = $.trim($('#toTel').val());
	var toMtel = $.trim($('#toMtel').val());
	var toAddr = $.trim($('#toAddr').val());
	var payMethod = $('input[name="payMethod"]:checked').val();
	var payEP = $.trim($('#payEP').val());
<?php 
if ($transCode!=1){
?>
	var payEPA = $.trim($('#payEPA').val());
<?php 
}
?>
	var payMonth = $('input[name="payMonth"]:checked').val();
	var invoiceType = $('input[name="invoiceType"]:checked').val();
	
	//var payMethod = $('input:radio:checked[name="payMethod"]').val();
	//var payMonth = = $('input:radio:checked[name="payMonth"]').val();
	//var invoiceType = = $('input:radio:checked[name="invoiceType"]').val();
	var invoiceName = $.trim($('#invoiceName').val());
	var invoiceNumber = $.trim($('#invoiceNumber').val());
	var invoiceTitle = $.trim($('#invoiceTitle').val());
	var tag=true;
	var msg='';
	if(toName == ''){
		msg=msg.concat('請输入收貨人姓名\n');
		tag=false;
	}
	if((toTel == '') && (toMtel == '')){
		msg=msg.concat('請输入收貨人手機或聯絡電話\n');
		tag=false;
	}
// 	if(toMtel == ''){
// 		msg=msg.concat('請输入收貨人手機號碼\n');
// 		tag=false;
// 	}
<?php 
if ($transCode=='1'){
?>
	if(toAddr == ''){
		msg=msg.concat('請输入收貨人聯絡地址\n');
		tag=false;
	}
<?php 
}
?>
	if(payMethod === undefined){
		msg=msg.concat('請選擇付款方式\n');
		tag=false;
	}
	else{
		if (payMethod=='5'){
			if ((Number(payEP)> <?=$totalCost?>)){
				$('#payEP').val('<?=$totalCost?>');
				payEP='<?=$totalCost?>';
			}
			else if ((Number(payEP)< <?=$totalCost?>)||((Number(payEP)> <?=$eff?>)&&(<?=$eff?> < <?=$totalCost?>))){
				if ((Number(payEP)> <?=$eff?>)&&(<?=$eff?> < <?=$totalCost?>)){
					$('#payEP').val('<?=$eff?>');
				}
			}
		}
<?php 
if ($transCode!=1){
?>
		else if (payMethod=='7'){
			if ((Number(payEPA)> <?=$totalCost?>)){
				$('#payEPA').val('<?=$totalCost?>');
				payEPA='<?=$totalCost?>';
			}
			else if ((Number(payEPA)< <?=$totalCost?>)||((Number(payEPA)> <?=$eff?>)&&(<?=$eff?> < <?=$totalCost?>))){
			if ((Number(payEPA)> <?=$eff?>)&&(<?=$eff?> < <?=$totalCost?>)){
					$('#payEPA').val('<?=$eff?>');
				}
			}
		}
<?php 
}
?>
	}
	if(invoiceType === undefined){
		msg=msg.concat('請選擇發票形式\n');
		tag=false;
	}
	else{
		if (invoiceType=='2'){
// 			if(invoiceName == ''){
// 				msg=msg.concat('請输入受買人\n');
// 				tag=false;
// 			}
			if(invoiceNumber == ''){
				msg=msg.concat('請输入統一編號\n');
				tag=false;
			}
			if(invoiceTitle == ''){
				msg=msg.concat('請输入發票抬頭\n');
				tag=false;
			}
		}
	}
	if (tag){
		document.getElementById('payForm').submit();
	}
	else{
		alert(msg);
	}
};
</script>
<!-- write code here -->
<div style="min-height: 700px;">
	<div>
		<div>
			<font style="font-size:30pt">購物車</font>
		</div>
		<div>
			<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
		</div>
		<div>
			<font style="font-size: 12px">HOME>購物車><font style="color:red">填寫訂單資訊</font></font>
		</div>
	</div>
	<br>
	<form id="payForm" action="index.php" enctype="multipart/form-data" method="POST">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div>
					<div style="font-size:20pt"><span class="numberCircle">&#9312;</span>訂購人資訊確認</div>
				</div>
				<div class="row">
					<input type="hidden" name="orderName" id="orderName" value=<?="'".$name."'"?>>
					<div class="col-md-6">
						<div style="font-size:15pt">
							姓名:<br>
							<?=$name?>
						</div>
					</div>
					<div class="col-md-6">
						<input type="hidden" name="orderMtel" id="orderMtel" value=<?="'".$mtel."'"?>>
						<div style="font-size:15pt">
							手機號碼:<br>
							<?=$mtel?>
						</div>
					</div>
					<div class="col-md-6">
						<input type="hidden" name="orderTel" id="orderTel" value=<?="'".$tel."'"?>>
						<div style="font-size:15pt">
							聯絡電話:<br>
							<?=$tel?>
						</div>
					</div>
<?php 
if ($transCode=='1'){
?>
					<div class="col-md-6">
						<input type="hidden" name="orderAddr" id="orderAddr" value=<?="'".$addr."'"?>>
						<div style="font-size:15pt">
							聯絡地址:<br>
							<?=$addr?>
						</div>
					</div>
<?php 
}
?>
				</div>		
				<br>
<?php 
if ($transCode=='1'){
?>
				<div>
					<div style="font-size:20pt">
						<span class="numberCircle">&#9313;</span>收貨人資訊填寫&nbsp;
						<input type="checkbox" id="sameAsOder" style="transform: scale(1.5);">&nbsp;<span style="font-size:15pt" >同訂購人資訊</span>
					</div>
				</div>
				<div class="row" style="font-size:15pt">
					<div class="col-md-5">
						<div class="form-group">
    						<label for="toName">姓名:</label>
    						<input type="text" class="form-control" id="toName" name="toName">
  						</div>					
						<div class="form-group">
    						<label for="toTel">聯絡電話:</label>
    						<input type="text" class="form-control" id="toTel" name="toTel">
  						</div>					
						<div class="form-group">
    						<label for="toMtel">手機號碼:</label>
    						<input type="text" class="form-control" id="toMtel" name="toMtel">
  						</div>
  						<div class="form-group">
    						<label for="toAddr">聯絡地址:</label>
    						<input type="text" class="form-control" id="toAddr" name="toAddr">
  						</div>					
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-5">
						<div class="form-group">
						    <label for="toNote">訂購備註</label>
						    <textarea class="form-control rounded-0" id="toNote" name="toNote" rows="13"></textarea>
						</div>
					</div>
				</div>
<?php 
}
else{
    if ($transCode=='2'){
        $tmpName="7-11";
    }
    else{
        $tmpName="全家";
    }
?>	
				<div>
					<div style="font-size:20pt">
						<span class="numberCircle">&#9313;</span>收貨人資訊填寫&nbsp;
						&nbsp;<span style="font-size:15pt"><?=$tmpName?>收貨 <?=$storeName?></span>
						<input type="checkbox" id="sameAsOder" style="transform: scale(1.5);">&nbsp;<span style="font-size:15pt" >同訂購人資訊</span>
					</div>
				</div>
				<div class="row" style="font-size:15pt">
					<div class="col-md-5">
						<div class="form-group">
    						<label for="toName">姓名:</label>
    						<input type="text" class="form-control" id="toName" name="toName" value="<?=$name?>">
  						</div>					
						<div class="form-group">
    						<label for="toTel">聯絡電話:</label>
    						<input type="text" class="form-control" id="toTel" name="toTel" value="<?=$tel?>">
  						</div>					
						<div class="form-group">
    						<label for="toMtel">手機號碼:</label>
    						<input type="text" class="form-control" id="toMtel" name="toMtel" value="<?=$mtel?>">
  						</div>
  						<div class="form-group">
    						<input type="hidden" class="form-control" id="toAddr" name="toAddr">
  						</div>					
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-5">
						<div class="form-group">
							<input type="hidden" class="form-control" id="oNote" name="oNote">
						</div>
					</div>
				</div>
<?php 
}
?>			
				<br>
				<div>
					<div style="font-size:20pt">
						<span class="numberCircle">&#9314;</span>選擇付款方式
					</div>
				</div>
				<table>
					<tr style="font-size:15pt">
						<td>
							<div class="custom-control custom-radio">
  								<input type="radio" id="payMethod1" name="payMethod" class="custom-control-input" value="1" style="transform: scale(1.5);" checked>
  								<label class="custom-control-label" for="payMethod1">信用卡&nbsp;&nbsp;&nbsp;支付<?=$totalCost?>&nbsp;&nbsp;&nbsp;</label>
							</div>
						</td>
<?php 

if ($eff>0){
?>
						<td>
							<div class="custom-control custom-radio">
  								<input type="radio" id="payMethod5" name="payMethod" class="custom-control-input" style="transform: scale(1.5);" value="5">
  								<label class="custom-control-label" for="payMethod5">購物金&nbsp;</label>
<?php 
    $tmpEff=$eff;
    $effMsg="";
    if ($eff> $totalCost){
        if ($totalCost>$totaExch_points){
            $tmpEff=$totaExch_points;
        }
        else{
            $tmpEff=$totalCost;
        }
    }
    if ($tmpEff<$totalCost){
        $diff=$totalCost-$tmpEff;
        $effMsg="信用卡支付：".$diff;
    }
?>
  								<input type="number" min="1" max="<?=$tmpEff?>" id="payEP" value=<?="'".$tmpEff."'"?> size="2" name="payEP" style="color:black;text-align:right;" disabled>
  								&nbsp;<span id="payEP1"><?=$effMsg?></span>
							</div>
						</td>
<?php 
}
?>
					</tr>
<?php 
if ($transCode!=1){
?>
					<tr style="font-size:15pt">
						<td>
							<div class="custom-control custom-radio">
  								<input type="radio" id="payMethod6" name="payMethod" class="custom-control-input" value="6" style="transform: scale(1.5);">
  								<label class="custom-control-label" for="payMethod1">貨到付款&nbsp;&nbsp;&nbsp;支付<?=$totalCost?>&nbsp;&nbsp;&nbsp;</label>
							</div>
						</td>
<?php 

    if ($eff>0){
?>
						<td>
							<div class="custom-control custom-radio">
  								<input type="radio" id="payMethod7" name="payMethod" class="custom-control-input" style="transform: scale(1.5);" value="7">
  								<label class="custom-control-label" for="payMethod5">購物金&nbsp;</label>
<?php 
        $tmpEff=$eff;
        $effMsg="";
        if ($eff> $totalCost){
            if ($totalCost>$totaExch_points){
                $tmpEff=$totaExch_points;
            }
            else{
                $tmpEff=$totalCost;
            }
        }
        if ($tmpEff<$totalCost){
            $diff=$totalCost-$tmpEff;
            $effMsg="貨到付款：".$diff;
        }
?>
  								<input type="number" min="1" max="<?=$tmpEff?>" id="payEPA" value=<?="'".$tmpEff."'"?> size="2" name="payEP" style="color:black;text-align:right;" disabled>
  								&nbsp;<span id="payEPA1"><?=$effMsg?></span>
							</div>
						</td>
<?php 
    }
?>
					</tr>
<?php 
}
?>
					<tr>
						<td style="padding-left:20px">
							<div style="background-color:white;color:black">

						</td>
					</tr>
				</table>			
				<br>
				<div>
					<div style="font-size:20pt">
						<span class="numberCircle">&#9315;</span>發票形式
						<span style="font-size: 15pt;color:red">(註:統一發票一經開立不得任意更改或改開其他式發票)</span>
					</div>
				</div>
				<table>
					<tr style="font-size:15pt">
						<td >
							<div class="custom-control custom-radio">
 								<input type="radio" id="invoiceType1" name="invoiceType" class="custom-control-input" value='1' style="transform: scale(1.5);" checked>
  								<label class="custom-control-label" for="invoiceType1">二聯式發票</label>
							</div>
						</td>
						<td>
							<div class="custom-control custom-radio">
 								<input type="radio" id="invoiceType2" name="invoiceType" class="custom-control-input" style="transform: scale(1.5);" value='2'>
  								<label class="custom-control-label" for="invoiceType2">三聯式發票</label>
							</div>
						</td>
					</tr>
				</table>				
				<div class="row" id="ivt3">
<!-- 					<div class="col-md-5"> -->
<!-- 						<div class="form-group"> -->
<!--     						<label for="invoiceName">受買人:</label> -->
<!--     						<input type="hidden" class="form-control" id="invoiceName" name="invoiceName"> -->
<!--   						</div>	 -->
<!-- 					</div> -->
<!-- 					<div class="col-md-1"></div> -->
<!-- 					<div class="col-md-5"> -->
<!-- 						<div class="form-group"> -->
<!--     						<label for="invoiceNumber">統一編號:</label> -->
<!--     						<input type="text" class="form-control" id="invoiceNumber" name="invoiceNumber"> -->
<!--   						</div>	 -->
<!-- 					</div> -->
<!-- 					<div class="col-md-5"> -->
<!-- 						<div class="form-group"> -->
<!--     						<label for="invoiceTitle">發票抬頭:</label> -->
<!--     						<input type="text" class="form-control" id="invoiceTitle" name="invoiceTitle"> -->
<!--   						</div>	 -->
<!-- 					</div> -->
				</div>				
			</div>
		</div>
		<input type="hidden" id="menuID" name="menuID" value="pay">
		<input type="hidden" id="step" name="payStep" value="1">
	</form>
	<div class="row">
		<div class="col-md-5 text-right">
			<a href="javascript:void(0)" onClick="toPay()" class="btn btn-danger" role="button">&nbsp;&nbsp;&nbsp;確認送出&nbsp;&nbsp;&nbsp;</a>
		</div>
		<div class="col-md-1"></div>
		<div class="col-md-5 text-left">
			<a href="javascript:history.back()" class="btn" style="background-color: #555555;color:white" role="button">&nbsp;&nbsp;&nbsp;回上一頁&nbsp;&nbsp;&nbsp;</a>
		</div>
	</div>
	<br><br><br>
</div>
<?php
    }
}
?>
