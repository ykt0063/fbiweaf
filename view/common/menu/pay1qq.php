<?php
use report\user\Session;
use report\tool\RegisterTool;
if (Session::get('tmpMBNO')!=FALSE){
    $tag=1;
    $mbno=Session::get('tmpMBNO');
}
elseif(Session::get('account')!=FALSE){
    $tag=0;
    $mbno=Session::get('account');
}
else{
    $tag=-1;
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
					<div class="col-md-6">
						<input type="hidden" name="orderAddr" id="orderAddr" value=<?="'".$addr."'"?>>
						<div style="font-size:15pt">
							聯絡地址:<br>
							<?=$addr?>
						</div>
					</div>
				</div>		
				<br>
				<div>
					<div style="font-size:20pt">
						<span class="numberCircle">&#9313;</span>收貨人資訊填寫&nbsp;
						<input type="checkbox" id="sameAsOder">&nbsp;<span style="font-size:15pt">同訂購人資訊</span>
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
  								<input type="radio" id="payMethod1" name="payMethod" class="custom-control-input" value="1">
  								<label class="custom-control-label" for="payMethod1">信用卡&nbsp;</label>
							</div>
						</td>
						<td>
							<div class="custom-control custom-radio">
  								<input type="radio" id="payMethod2" name="payMethod" class="custom-control-input" value="2">
  								<label class="custom-control-label" for="payMethod2">銀聯卡&nbsp;</label>
							</div>
						</td>
						<td>
							<div class="custom-control custom-radio">
  								<input type="radio" id="payMethod3" name="payMethod" class="custom-control-input" value="3">
  								<label class="custom-control-label" for="payMethod3">超商條碼&nbsp;</label>
							</div>
						</td>
						<td>
							<div class="custom-control custom-radio">
  								<input type="radio" id="payMethod4" name="payMethod" class="custom-control-input" value="4">
  								<label class="custom-control-label" for="payMethod4">超商代碼&nbsp;</label>
							</div>
						</td>
						<td>
							<div class="custom-control custom-radio">
  								<input type="radio" id="payMethod5" name="payMethod" class="custom-control-input" value="5">
  								<label class="custom-control-label" for="payMethod5">ATM轉帳</label>
							</div>
						</td>
					</tr>
					<tr>
						<td style="padding-left:20px">
							<div style="background-color:white;color:black">
								<div class="custom-control custom-radio">
  									<input type="radio" id="payMethod1a" name="payMonth" class="custom-control-input" value="a">
  									<label class="custom-control-label" for="payMethod1a">3期</label>
								</div>
								<div class="custom-control custom-radio">
  									<input type="radio" id="payMethod1b" name="payMonth" class="custom-control-input" value="b">
  									<label class="custom-control-label" for="payMethod1b">6期</label>
								</div>
								<div class="custom-control custom-radio">
  									<input type="radio" id="payMethod1a" name="payMonth" class="custom-control-input" value="c">
  									<label class="custom-control-label" for="payMethod1c">12期</label>
								</div>
							</div>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
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
 								<input type="radio" id="invoiceType1" name="invoiceType" class="custom-control-input" value='1'>
  								<label class="custom-control-label" for="invoiceType1">電子發票</label>
							</div>
						</td>
						<td>
							<div class="custom-control custom-radio">
 								<input type="radio" id="invoiceType2" name="invoiceType" class="custom-control-input" value='2'>
  								<label class="custom-control-label" for="invoiceType2">三聯式發票</label>
							</div>
						</td>
					</tr>
				</table>
				<div class="row">
<!-- 					<div class="col-md-5"> -->
<!-- 						<div class="form-group"> -->
<!--     						<label for="invoiceName">受買人:</label> -->
<!--     						<input type="text" class="form-control" id="invoiceName" name="invoiceName"> -->
<!--   						</div>	 -->
<!-- 					</div> -->
<!-- 					<div class="col-md-1"></div> -->
					<div class="col-md-5">
						<div class="form-group">
    						<label for="invoiceNumber">統一編號:</label>
    						<input type="text" class="form-control" id="invoiceNumber" name="invoiceNumber">
  						</div>	
					</div>
					<div class="col-md-5">
						<div class="form-group">
    						<label for="invoiceTitle">發票抬頭:</label>
    						<input type="text" class="form-control" id="invoiceTitle" name="invoicetitle">
  						</div>	
					</div>
				</div>				
			</div>
		</div>
		<input type="hidden" id="menuID" name="menuID" value="pay">
		<input type="hidden" id="step" name="payStep" value="1">
	</form>
	<div class="row">
		<div class="col-md-5 text-right">
			<a href="#" class="btn btn-danger" role="button">&nbsp;&nbsp;&nbsp;確認送出&nbsp;&nbsp;&nbsp;</a>
		</div>
		<div class="col-md-1"></div>
		<div class="col-md-5 text-left">
			<a href="#" class="btn" style="background-color: #555555;color:white" role="button">&nbsp;&nbsp;&nbsp;回上一頁&nbsp;&nbsp;&nbsp;</a>
		</div>
	</div>
	<br><br><br>
</div>
<?php
    }
}
?>