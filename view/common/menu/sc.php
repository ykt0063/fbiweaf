<?php
use report\tool\ShoppingCart;
use report\user\Session;
use report\user\product;
$opCode=isset($g['opCode'])?$g['opCode']:'';
$transCode=isset($g['transCode'])?$g['transCode']:'1';
$prodNo='';
if (($opCode=='edit') && is_numeric ($number)){
    $prodNo=isset($g['prodNo'])?$g['prodNo']:'';
    $number=isset($g['number'])?$g['number']:'';
    if ($prodNo!=''){
        ShoppingCart::editCart($prodNo, $number);
    }
}
// if ($opCode=='delete'){
//     $prodNo=isset($g['prodNo'])?$g['prodNo']:'';
//     if ($prodNo!=''){
//         ShoppingCart::deleteCartData($prodNo);
//     }
// }
$totaExch_points=0;
$FreightTag='checked';
$CStoreTag='';
$CStoreTag711='';
$tFee=TRANSFee;
if ($opCode=='transWay'){
    $transCode=isset($g['TransMethod'])?$g['TransMethod']:$transCode;
}
if ($transCode!='1'){
    $FreightTag='';
    if ($transCode=='2'){
        $CStoreTag711='checked';
    }
    else{
        $CStoreTag='checked';
    }
    $tFee=SEVENFee;
}
$obj=array('transCode'=>$transCode,'tFee'=>$tFee);
Session::save($obj);
$cart=ShoppingCart::getCartDataList();
$num=$cart['cartNo'];
$disabled = "";

if ($num==0){
    $disabled=" disabled ";
}
include "mm.php";
?>
<div style="min-height: 700px;">
	<div>
		<div>
			<font style="font-size:30pt">購物車</font>
		</div>
		<div>
			<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
		</div>
		<div>
			<font style="font-size: 12px">HOME>購物車><font style="color:red">確認訂單</font></font>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-20-cols text-center">
			<div>
				<table class="table table-bordered">
					<tbody>
					<tr style="background-color:red;color:white">
						<th class="text-center"><div style="font-size:15pt">產品名稱</div></th>
						<th class="text-center"><div style="font-size:15pt">單價</div></th>
						<th class="text-center"><div style="font-size:15pt">數量</div></th>
						<th class="text-center"><div style="font-size:15pt">小計</div></th>
						<th class="text-center"><div style="font-size:15pt">刪除</div></th>
					</tr>
<?php
$prices=0;
$pvs=0;
for($i=0;$i<$num;$i++){
    $ci=$cart[$i];
    $price=$ci["price"];
    $pv=$ci['pv'];
    $name=$ci['prodName'];
    $no=$ci['prodNo'];
    $number=$ci['number'];
    $exch_points=$ci['exch_points'];
    $prices=$prices+$price*$number;
    $pvs=$pvs+$pv*$number;
    $totaExch_points=$totaExch_points+$exch_points*$number;
    $pic=product::getProductImagePath($no)
?>
					<tr class="text-left" style="background-color: white;color:black">
						<td class="">
							<div class="row">
								<div class="col-md-4">
									<img src="<?=$pic?>" class="img-thumbnail">
								</div>
								<div class="col-md-8">
									<table style="height: 100px;">
										<tbody>
											<tr>
												<td class="align-middle"><div style="font-size:15pt"><font style="color:red"><?=$name?></font></div></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</td>
						<td class=""><div style="font-size:15pt"><font><?=$price?>元</font></div></td>
						<td class="">
							<form id="editForm" action="index.php" enctype="multipart/form-data" method="POST">
    							<input type="number" min="1" max="100" id ="pdNum" value=<?="'".$number."'"?> size="3" name="number" style="color:black;text-align:right;">&nbsp;
    							<input type="hidden" id="menuID" name="menuID" value="sc">
    							<input type="hidden" id="opCode" name="opCode" value="edit">
    							<input type="hidden" id="prodNo" name="prodNo" value="<?=$no?>">
    							<input type="hidden" id="transCode" name="transCode" value="<?=$transCode?>">
<!--     							<button type="submit" class="btn  btn btn-danger"> -->
<!--     								<span class="glyphicon glyphicon-refresh"></span> -->
<!--     							</button> -->
    						</form>
						</td>
						<td class=""><div style="font-size:15pt"><font><?=$price*$number?>元</font></div></td>
						<td class="">
							<form id="delForm" action="index.php" enctype="multipart/form-data" method="POST">
	    						<input type="hidden" id="menuID" name="menuID" value="sc">
	    						<input type="hidden" id="opCode" name="opCode" value="delete">
	    						<input type="hidden" id="prodNo" name="prodNo" value="<?=$no?>">
    							<input type="hidden" id="transCode" name="transCode" value="<?=$transCode?>">
	    						<button type="submit" class="btn  btn btn-danger">
	    							<span class="glyphicon glyphicon-remove-circle"></span>
	    						</button>
	    					</form>
						</td>
					</tr>
<?php
}
$obj=array("totaExch_points"=>$totaExch_points);
Session::save($obj);
$freight=0;
if ($prices<FREEQUOTA && $prices>0){
    $freight=$tFee;
}
?>
					<tr>
						<td colspan="6">
							<form id="transForm" action="index.php" enctype="multipart/form-data" method="POST">
								<p class="custom-control custom-radio">
  									<input type="radio" class="TransMethod" id="TransMethod1" name="TransMethod" class="custom-control-input" value="1" style="transform: scale(1.5);" <?=$FreightTag?>>
  									<label class="custom-control-label" for="TransMethod1" style="font-size:18pt"><font color="blue">貨運&nbsp;</font></label><br>
  									<input type="radio" class="TransMethod" id="TransMethod2" name="TransMethod" class="custom-control-input" value="2" style="transform: scale(1.5);" <?=$CStoreTag711?>>
									<label class="custom-control-label" for="TransMethod2" style="font-size:18pt"><font color="blue">7-11取貨&nbsp;</font></label><br>
<!--
  									<input type="radio" class="TransMethod" id="TransMethod3" name="TransMethod" class="custom-control-input" value="3" style="transform: scale(1.5);" <?=$CStoreTag?>>
									<label class="custom-control-label" for="TransMethod3" style="font-size:18pt"><font color="blue">全家取貨&nbsp;</font></label>
-->
								</p>
	    						<input type="hidden" id="menuID" name="menuID" value="sc">
	    						<input type="hidden" id="opCode" name="opCode" value="transWay">
	    						<input type="hidden" id="prodNo" name="prodNo" value="<?=$prodNo?>">
    							<input type="hidden" id="transCode" name="transCode" value="<?=$transCode?>">
	    					</form>
						</td>
					</tr>
					<tr>
						<td colspan="6">
							<font>貨運運費<?=TRANSFee?>元。</font>
						</td>
					</tr>
					<tr>
						<td colspan="6">
							<font>超商店到店運費<?=SEVENFee?>元(限本島)重量不得超過5公斤。</font>
						</td>
					</tr>
					<tr>
						<td colspan="6">
							<font>*單筆訂單，若總重量超過5公斤，請點選貨運配送，謝謝！</font>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-5-cols">
			<div class="text-right">
				<table class="table table-bordered ">
					<tbody>
						<tr>
							<td class=""><div style="font-size:15pt"><strong>合計</strong></div></td>
							<td class=""><div style="font-size:15pt"><?=$prices?></div></td>
						</tr>
						<tr>
							<td class=""><div style="font-size:15pt"><strong>運費</strong></div></td>
							<td class=""><div style="font-size:15pt"><?=$freight?>元</div></td>
						</tr>
						<tr style="background-color:pink;color:red">
							<td class=""><div style="font-size:15pt"><strong>總計</strong></div></td>
							<td class=""><div style="font-size:15pt"><?=$freight+$prices?>元</div></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="text-center">
				<form id="payForm" action="index.php" enctype="multipart/form-data" method="POST">
    				<input type="hidden" id="menuID" name="menuID" value="pay">
    				<input type="hidden" id="transCode" name="transCode" value="<?=$transCode?>">
    				<input type="hidden" id="tFee" name="tFee" value="<?=$tFee?>">
    				<input type="hidden" id="totalCost" name="totalCost" value="<?=$freight+$prices?>">
    				<button type="submit" class="btn  btn btn-danger" <?=$disabled?>>
    					<span class=""><div style="font-size:15pt">前往結帳</div></span>
    				</button>
    			</form>
			</div>
			<br>
			<div class="text-center">
				<form id="buyForm" action="index.php" enctype="multipart/form-data" method="POST">
    				<input type="hidden" id="menuID" name="menuID" value="0">
    				<input type="hidden" id="mainID" name="mainID" value="1">
    				<button type="submit" class="btn" style="background-color: #555555">
    					<span class=""><div style="font-size:15pt">繼續購物</div></span>
    				</button>
    			</form>
			</div>
			<br>
			<div class="text-center">
				<button id="returnID">換貨說明</button>
			</div>
			<br>
		</div>
	</div>
</div>
<script>
$(document).ready(function() { 
    $(".TransMethod").change(function() { 
    	$( "#transForm" ).submit();
    }); 
    $("#pdNum").change(function() { 
    	$( "#editForm" ).submit();
    });
    $('#returnID').click(function(){
        var str="換貨說明\n\n";
        str=str+"1退貨：依消費者保護法第19條，商品貨到日起7天享猶豫期權益．但猶豫期非試用期。退貨時敬請保持原包裝商品的完整，我們完全保障您的購物權益。根據消保法規定，於網路訂購的商品皆享有七天鑑賞期的權益，但商品如經拆封、使用、或拆解以致缺乏商品完整性、失去再販售的價值時，恕無法提供您退貨的服務。退貨申請時間超過七日鑑賞期無法提供退貨服務。\n";
        str=str+"\n";
        str=str+"2.退貨注意事項：退貨的商品必須回復原狀，亦即必須回復至您收到商品時的原始狀態 ( 包含：內外包裝、隨機文件、贈品、活動贈品等 ) ，本公司網站不提供換貨服務。欲更換其他商品，請依照退貨流程將商品退回，並重新於網站訂購。\n";
        str=str+"\n";
        str=str+"3.若您有申請紙本發票，請於退貨時一並退回（一般電子發票不需退還，我們會做廢電子發票）。\n";
        str=str+"\n";
        str=str+"4.請您以收件時所使用之包裝紙箱將退貨商品包裝妥當，若原紙箱已遺失，請另使用其他紙箱於商品原廠包裝之外，切勿直接於商品包裝上黏貼紙張或書寫文字。若原廠包裝有毀損將無法退貨。\n\n";
        str=str+"•提醒您：，如經拆封即無法退貨。•欲退貨之商品，請包裝完整堅固，避免物流配送過程中因商品損毀而影響您的退貨行使權利或需負擔毀壞之費用。•付款若為信用卡一次付款，如欲退貨，費用會整筆退回，如整筆訂單購買兩樣以上商品，則不可單獨退貨，需將整筆訂單商品一併退回。•購物金經使用後即無法歸還，日後訂單退貨或取消，恕不歸還，請務必留意購物金使用說明。•如以產品瑕疵名義申請退貨，經確認產品並無瑕疵，將不會核准此筆退貨；因有誠信之疑慮，如有上述情形發生，將可能對該會員拒絕交易或永久取消會員資格辦理，請務必留意。•如發生會員大量退換貨，因已造成作業上之困擾，成泰生物科技有限公司會視情況對該會員採取拒絕交易或永久取消其會員資格辦理。\n";
        str=str+"\n";
        str=str+"退款方式\n";
        str=str+"\n";
        str=str+"1.將比照原訂單付款方式，信用卡退刷時間會受個人信用卡結帳週期影響，負項金額可能會落在下期信用卡帳單上，請您留意下期信用卡帳單，或向您的信用卡發卡銀行洽詢。\n";
        str=str+"\n";
        str=str+"2.若使用ATM匯款或超商取貨付款，則需填寫匯款帳號以利後續退款作業。退款帳戶若不是台灣企銀，退款金額會與您扣除15元手續費。\n";
        str=str+"\n";
        str=str+"3.本公司收到您所退回的商品後，作業完成確認無誤後，將於15-20個工作天內為您辦理退款。\n";
        str=str+"\n";
        str=str+"退貨運費\n";
        str=str+"\n";
        str=str+"請確認檢附原始發票和退貨理由。您須自行負擔<?=TRANSFee?>元退貨運費，外島及海外地區則需負擔全額運費。\n";
        str=str+"\n";
        alert(str);
    });
}); 
</script>
