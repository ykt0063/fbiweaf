<?php
use report\base\Json;
use report\organization\Personal;
use report\user\Session;
$creditTag=false;
if (null!=Session::get('account')){
    $account=SESSION::get('account');
    if (isset($g['ordno']) && $g['ordno']!=''){
        $ordNO=$g['ordno'];
        $obj = Personal::getOrderDetail($account,$ordNO);
        if (sizeof($obj)>0){
            $M=$obj['data'][0];
            $orderM=array();
            for ($i=0;$i<sizeof($M);$i++){
                $orderM['ORD_NO']=$M[$i][0];
                $orderM['ORD_DATE']=$M[$i][1];
                $orderM['MB_NO']=$M[$i][2];
                $orderM['MB_NAME']=$M[$i][3];
                $orderM['SEND_METHOD']=$M[$i][4];
                $orderM['SEND_MONEY']=$M[$i][5];
                $orderM['RECEIVER']=$M[$i][6];
                $orderM['IO_KIND']=$M[$i][7];
                $orderM['WEEK_NO']=$M[$i][8];
                $orderM['EXCH_POINTS']=$M[$i][9];
                $orderM['ADD_SEND']=$M[$i][10];
                $orderM['CARGO_NO']=$M[$i][11];
                $orderM['STORE_NAME']=$M[$i][12];
                $orderM['STORE_ID']=$M[$i][13];
                $orderM['ORDER_MONEY']=$M[$i][14];
                $orderM['postData']=$M[$i][15];
                $orderM['trasFee']=$orderM['SEND_MONEY']- $orderM['ORDER_MONEY'];
                if (strlen($orderM['postData'])>0){
                    $tmpData=Json::decode(base64_decode($orderM['postData']));
                    $orderM['postData']=$tmpData;
                    $creditTag=true;
                }
            }
            $D=$obj['data'][1];
            $orderD=array();
            for ($i=0;$i<sizeof($D);$i++){
                $orderD[]=array(
                    'SEQ_NO'=>$D[$i][0],
                    'PROD_NO'=>$D[$i][1],
                    'PROD_NAME'=>$D[$i][2],
                    'QTY'=>$D[$i][3],
                    'PROD_UNIT'=>$D[$i][4],
                    'PRICE'=>$D[$i][5],
                );
            }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
  <title>訂單<?=$ordNO?>明細</title>
  <style type="text/css">
    .text-center{
        text-align:center;
    }
    .text-right{
        text-align:right;
    }
  </style>
</head>
<body>

	    <div style="max-width: 700px;">
    	<div>
			<div>
				<font style="font-size:30pt">訂單明細</font>
			</div>
			<div>
				<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
			</div>
			<div>
				<font style="font-size: 12px">HOME>會員中心><font style="color:red">-帳號：<?=$account?> 訂單編號:<?=$ordNO?></font></font>
			</div>
		</div>
		<div>
			<table class="table table-hover" style="border:3px #cccccc solid;" cellpadding="10" border='1'>
            	<tbody>
            	  <tr>
            	    <td class="text-center" style="width: 80pt">訂購日期</td>
            	    <td class="text-center"><?=$orderM['ORD_DATE']?></td>
            	  </tr>
            	  <tr>
            	    <td class="text-center">總金額</td>
            	    <td class="text-center"><?=$orderM['SEND_MONEY']?></td>
            	  </tr>
            	  <tr>
            	    <td class="text-center">購買金額</td>
            	    <td class="text-center"><?=$orderM['ORDER_MONEY']?></td>
            	  </tr>
            	  <tr>
            	  	<td class="text-center">類別</td>
            	  	<td class="text-center"><?=$orderM['IO_KIND']?></td>
            	  </tr>
            	  <tr>
            	    <td class="text-center">收件人</td>
            	    <td class="text-center"><?=$orderM['RECEIVER']?></td>
            	   </tr>
                   <tr>
                   <tr>
            	    <td class="text-center">訂購方式</td>
            	    <td class="text-center"><?php if($orderM['SEND_METHOD']==2){ echo "超商";} else{ echo "貨運";}?></td>
            	  </tr>
            	 <tr>
            	    <td class="text-center">運送費用</td>
            	    <td class="text-center"><?=$orderM['trasFee']?></td>
            	   </tr>
<?php 
            if ($orderM['SEND_METHOD']==2){
?>
				  <tr>
				   	<td class="text-right">超商店名&nbsp;&nbsp;</td>
				   	<td class="text-center"><?=$orderM['STORE_NAME']?></td>
				  </tr>
				  <tr>
				   	<td class="text-right">超商編號&nbsp;&nbsp;</td>
				   	<td class="text-center"><?=$orderM['STORE_ID']?></td>
				  </tr>
				  <tr>
				   	<td class="text-right">取件號碼&nbsp;&nbsp;</td>
				   	<td class="text-center"><?=$orderM['CARGO_NO']?></td>
				  </tr>
<?php 
            }
            else{
?>
				  <tr>
					<td class="text-right">收件地址&nbsp;&nbsp;</td>		   	
					<td class="text-center"><?=$orderM['ADD_SEND']?></td>		   	
				  </tr>
<?php 
            }
            if ($creditTag){
?>
				  <tr>
					<td class="text-right">信用卡核准碼&nbsp;&nbsp;</td>		   	
					<td class="text-center"><?=$orderM['postData']['ApproveCode']?></td>		   	
				  </tr>
				  <tr>
					<td class="text-right">信用卡末四碼&nbsp;&nbsp;</td>		   	
					<td class="text-center"><?=$orderM['postData']['Card_NO']?></td>		   	
				  </tr>
				  <tr>
					<td class="text-right">信用卡金額&nbsp;&nbsp;</td>		   	
					<td class="text-center"><?=$orderM['postData']['MN']?></td>		   	
				  </tr>
<?php 
            }
?>
                   <tr>
            	    <td class="text-center">業績周別</td>
            	    <td class="text-center"><?=$orderM['WEEK_NO']?></td>
            	   </tr>
            	   <tr>
            	    <td class="text-center">購物金-金額</td>
            	    <td class="text-center"><?=$orderM['EXCH_POINTS']?></td>
            	   </tr>
            	</tbody>
            </table>
		</div>
		<br>
		<div>
			<table class="table table-hover" style="border:3px #cccccc solid;" cellpadding="10" border='1'>
				<thead>
            	  <tr>
            	    <td class="text-center">產品名稱</td>
            	    <td class="text-center">產品編號</td>
            	    <td class="text-center">數量</td>
            	    <td class="text-center">單位</td>
            	    <td class="text-center">單價</td>
            	    <td class="text-center">小計</td>
            	  </tr>
            	</thead>
            	<tbody>
<?php 
            for($i=0;$i<sizeof($orderD);$i++){
                $data=$orderD[$i];
                $prdName=$data['PROD_NAME'];
                $prdNO=$data['PROD_NO'];
                $qty=$data['QTY'];
                $unit=$data['PROD_UNIT'];
                $price=$data['PRICE'];
                $tt=(int)$qty*(int)$price;
?>
					<tr>
						<td class="text-center"><?=$prdName?></td>
						<td class="text-center"><?=$prdNO?></td>
						<td class="text-center"><?=$qty?></td>
						<td class="text-center"><?=$unit?></td>
						<td class="text-center"><?=$price?></td>
						<td class="text-center"><?=$tt?></td>
					</tr>
<?php 
            }
?>            	
	            </tbody>	
			</table>
		</div>
	</div>
</body>
</html>
<?php 
        }
    }
}