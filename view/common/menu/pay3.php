<?php
use report\base\Json;
use report\order\Products;
use report\tool\RegisterTool;
use report\tool\ShoppingCart;
use report\user\Session;
use report\user\product;
$objStr=Session::get('objStr');
$obj=Json::decode(base64_decode($objStr));
$orderName=$obj['orderName'];
$orderTel=$obj['orderTel'];
$orderMtel=$obj['orderMtel'];
$orderAddr=$obj['orderAddr'];
$toName=$obj['toName'];
$toTel=$obj['toTel'];
$toMtel=$obj['toMtel'];
$toAddr=$obj['toAddr'];
$toNote=$obj['toNote'];
$payMethod=$obj['payMethod'];
$payMonth=$obj['payMonth'];
$invoiceType=$obj['invoiceType'];
$invoiceName=$obj['invoiceName'];
$invoiceNumber=$obj['invoiceNumber'];
$invoiceTitle=$obj['invoiceTitle'];
$payEP=$obj['payEP']; //購物金付款金額
$cCost=$obj['total']; //信用卡付款金額
$outsideTag=$obj['outsideTag'];
$transCode=Session::get('transCode');
$storeName=Session::get('storeName');
if ($transCode=="1"){
    $transMsg="(貨運)";
}
else{
    if ($transCode=='2'){
        $transMsg="(7-11 ".$storeName."店 取貨)";
    }
    else{
        $transMsg="(全家 ".$storeName."店 取貨)";
    }
}
$pm="";
$DATA_FLAG='';
switch ($payMethod){
    case 1:
        $pm="信用卡付款";
        $DATA_FLAG='Y';
        break;
    case 2:
        $pm="銀聯卡付款";
        $DATA_FLAG='Y';
        break;
    case 3:
        $pm="超商條碼";
        $DATA_FLAG='Y';
        break;
    case 4:
        $pm="超商代碼";
        $DATA_FLAG='Y';
        break;
    case 5:
        $pm="購物金";
        $DATA_FLAG='Y';
        break;
    case 7:
        $pm="超商到貨付款";
        $DATA_FLAG='Y';
        break;
}
if ($payMethod==5){
    $pm=$pm." 抵扣".$payEP;
    $cCard='';
    if ($cCost>0){
        $pm=$pm." 信用卡".$cCost;
    }
}
else if($payMethod==7){
    $pm=$pm." 抵扣".$payEP;
    $cCard='';
    if ($cCost>0){
        $pm=$pm." 到貨付款".$cCost;
    }
    
}
else{
    $payEP=0;
    $pm=$pm." 信用卡".$cCost;
}
$iType="";
switch($invoiceType){
    case 1:
        $iType="二聯式發票";
        break;
    case 2:
        $iType="三聯式發票";
        break;
}
$cart=$obj['cart'];
$num=$cart['cartNo'];
$tag=$obj['tag'];
$mbno=$obj['mbno'];
// if (!$tag){
//     RegisterTool::OfficialRegistration();
// }

//ShoppingCart::deleteAllCartData();
//Session::delete('payTime');
$tid=SESSION::get('tid');
$date=SESSION::get('date');
//Session::delete('objStr');
//Session::delete('tid');
//Session::delete('date');

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
			<font style="font-size: 12px">HOME>購物車><font style="color:red">完成訂單</font></font>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div>
				<div style="font-size:20pt"><span class="numberCircle">&#9312;</span>訂單完成</div>
				<div style="font-size:15pt">
<?php
if ($payMethod==7){
?>
					<div>感謝您的下單,請於收到通知以後，盡速前往超商取貨繳款,</div>
<?php     
}
else{
?>
					<div>感謝您的下單,您的交易已經完成</div>
<?php
}
?>
				</div>
			</div>
			<br>
			<div>
				<div style="font-size:20pt"><span class="numberCircle">&#9313;</span>訂單明細</div>
				<div style="font-size:14pt">
					<div>訂購日期: <?=$date?> 訂單編號: <?=$tid?> 付款方式: <?=$pm?></div>
				</div>
				
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
								</tr>
<?php
$prices=0;
$pvs=0;
$odStr='';
for($i=0;$i<$num;$i++){
    $ci=$cart[$i];
    $price=$ci["price"];
    $pv=$ci['pv'];
    $name=$ci['prodName'];
    $no=$ci['prodNo'];
    $number=$ci['number'];
    $unit=$ci['unit'];
    $prices=$prices+$price*$number;
    $pvs=$pvs+$pv*$number;
    $pic=product::getProductImagePath($no);
    $odStr=$odStr.$no.":".$name.":".$number.":".$price.":".$pv;
    if ($i!=$num-1){
        $odStr=$odStr."|";
    }
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
									<td class=""><div style="font-size:15pt"><font><?=$number?><?=$unit?></font></div></td>
									<td class=""><div style="font-size:15pt"><font><?=$price*$number?>元</font></div></td>
								</tr>
<?php
}
$freight=Session::get('tFee');
if ($freight+$prices>FREEQUOTA){
    $freight=0;
}
?>
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
					</div>
				</div>												
			</div>
			
			<br>
			<div>
				<div style="font-size:20pt"><span class="numberCircle">&#9314;</span>訂購人資訊</div>
				<div class="row" style="font-size:15pt">
					<div class="col-md-6">
						<div>姓名:&nbsp;<font style="color:blue"><?=$orderName?></font></div>
					</div>
					<div class="col-md-6">
						<div>手機號碼:&nbsp;<font style="color:blue"><?=$orderMtel?></font></div>
					</div>
					<div class="col-md-6">
						<div>聯絡電話:&nbsp;<font style="color:blue"><?=$orderTel?></font></div>
					</div>
					<div class="col-md-6">
						<div>聯絡地址:&nbsp;<font style="color:blue"><?=$orderAddr?></font></div>
					</div>
				</div>
			</div>
			
			<br>
			<div>
				<div style="font-size:20pt"><span class="numberCircle">&#9315;</span>收貨人資訊 <?=$transMsg?></div>
				<div class="row" style="font-size:15pt">
					<div class="col-md-6">
						<div>姓名:&nbsp;<font style="color:blue"><?=$toName?></font></div>
						<div>手機號碼:&nbsp;<font style="color:blue"><?=$toMtel?></font></div>
						<div>聯絡電話:&nbsp;<font style="color:blue"><?=$toTel?></font></div>
						<div style="word-wrap:break-word">聯絡地址:&nbsp;<font style="color:blue"><?=$toAddr?></font></div>
					</div>
					<div class="col-md-6">
						<div style="word-wrap:break-word">訂購備註:<br><font style="color:blue"><?=$toNote?></font></div>
					</div>
				</div>
			</div>
			
			<br>
			<div>
				<div style="font-size:20pt">
					<span class="numberCircle">&#9316;</span>發票形式&nbsp;-&nbsp;<span style="color:green"><?=$iType?></span> &nbsp;
					<span style="font-size:15pt;color:red">(註:統一發票一經開立不得任意更改或改開其他式發票)</span>
				</div>
<?php 
if ($iType==2){
?>
				<div class="row" style="font-size:15pt">
					
					<div class="col-md-6">
						<div>受買人:&nbsp;<font style="color:blue"><?=$invoiceName?></font></div>
					</div>
					<div class="col-md-6">
						<div>統一編號:&nbsp;<font style="color:blue"><?=$invoiceNumber?></font></div>
					</div>
					<div class="col-md-6">
						<div>發票抬頭:&nbsp;<font style="color:blue"><?=$invoiceTitle?></font></div>
					</div>
				</div>
<?php 
}
else{
?>
				<br>
<?php 
}
?>
			</div>
		</div>
	</div>
	<div class="text-center">
		<form id="buyForm" action="index.php" enctype="multipart/form-data" method="POST">
    		<input type="hidden" id="menuID" name="menuID" value="0">
    		<input type="hidden" id="mainID" name="mainID" value="1">
    		<input type="hidden" id="scClear" name="scClear" value="1">
    		<button type="submit" class="btn btn-danger"">
    			<span class=""><div style="font-size:15pt">&nbsp;&nbsp;&nbsp;繼續購物&nbsp;&nbsp;&nbsp;</div></span>
    		</button>
    	</form>
	</div>
</div>
<?php 
$orderObj=array(
    'tid'=>$tid,
    'RECEIVER'=>$toName,
    'TEL'=>$toTel,
    'ADD_SEND'=>$toAddr,
    'POST_NO'=>'',
    'From_WHERE'=>1,
    'REMARK'=>$toNote,
    'ORDER_MONEY'=>$prices,
    'ORDER_PV'=>$pvs,
    'TOTAL_MONEY'=>$prices+$freight,
    'PV'=>$pvs,
//     'SEND_MONEY'=>$prices+$freight,
    'SEND_MONEY'=>$freight,
    'detail'=>$odStr,
    'number'=>$num,
    'DATA_FLAG'=> $DATA_FLAG,
    'payEP'=>$payEP,
    'cCost'=>$cCost,
    'transCode'=>$transCode,
);
if ($transCode!='1'){
    $orderObj['storeID']=Session::get('storeID');
    $orderObj['storeName']=Session::get('storeName');
    $orderObj['storeAddr']=Session::get('storeAddr');
}
$obj=array('orderM'=>$orderObj);
Session::save($obj);

$obj=Session::get('orderM');
$obj1=Session::get('orderM1');
$obj['InvoiceNo']=$obj1['InvoiceNo'];
$obj['CargoNo']=$obj1['CargoNo'];
$obj['Card_NO']=$obj1['Card_NO'];
$obj['ApproveCode']=$obj1['ApproveCode'];

$obj['invoiceType']=$invoiceType;
$obj['invoiceName']=$invoiceName;
$obj['invoiceNumber']=$invoiceNumber;
$obj['invoiceTitle']=$invoiceTitle;
    if ($obj && $obj1){
    if ($payMethod!=7)
        Products::SetOfficialOrder($obj);
    $payEP=$obj['payEP'];
    $eff=Session::get('eff');
    //$uneff=Session::get('uneff');
    $eff=$eff-$payEP;
    // $uneff=$uneff + $payEP;
    $obj=array('eff'=>$eff);
    Session::save($obj);
}
ShoppingCart::deleteAllCartData();
Session::delete('payTime');
//     $tid=SESSION::get('tid');
//     $date=SESSION::get('date');
Session::delete('objStr');
Session::delete('orderM');
Session::delete('orderM1');
Session::delete('tid');
Session::delete('date');
Session::delete('transCode');
Session::delete('storeID');
Session::delete('storeName');
Session::delete('storeAddr');
Session::delete('storeType');
Session::delete('storeMsg');
$obj=array("scClear"=>1);
Session::save($obj);
?>