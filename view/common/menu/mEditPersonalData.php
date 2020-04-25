<?php

use report\organization\Personal;
use report\user\Auth;
use report\user\Session;
$account='';
// $listA=array();
$str='';
$Line_Head_Flag = array();
for ($i = 1; $i <= 80; $i++) {
    $Line_Head_Flag[$i] = 1;
    //$output=implode(",",$Line_Head_Flag);
}
$columnName=array();
if (null!=SESSION::get('account')){
    $account=SESSION::get('account');
    $obj = Auth::getPersonalData($account);
    $name="";
    $addr="";
    $tel="";
    $birth="";
    $email="";
    if ($obj['code']==0){
        $data=$obj['desc']['desc'];
        $name=$data['name'];
        $email=$data['email'];
        $tel=$data['tel'];
        $addr=$data['addr'];
        $birth=$data['birth'];
        $birth=date_create($birth)->format('Y-m-d'); 
    }
    ?>
<div style="min-height: 700px;  color: black;">
	<div>
		<div>
			<font style="font-size:30pt;">調整個人資料</font>
		</div>
		<div>
			<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
		</div>
		<div>
			<font style="font-size: 12px">HOME>會員中心><font style="color:red">帳號：<?=$account?> 調整個人資料</font></font>
		</div>
	</div>
	<br>
	<div>
		<form class="form-horizontal"  role="form" id="mainForm" enctype="multipart/form-data" method="post">
			<input type="hidden" class="form-control input-lg" id="mbno" name="mbno" value="<?=$account?>">
			<div class="form-group">
				<div class="row">
					<div class="col-md-5">
						<div class="row">							
							<div class="col-md-6 regwd">
								<label for "name" class="control-label"><font face="標楷體" style="font-size: 15px">姓名:</font></label>
								<input type="text" class="form-control input-lg" id="name" name="name" value="<?=$name?>" placeholder="">
							</div>
						</div>	
					</div>
					<div class="col-md-1">
					</div>
					<div class="col-md-5">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6 regwd">
									<label for "birth" class="control-label"><font face="標楷體" style="font-size: 15px">生日:</font></label>
<!-- 				   				<img src="assets/images/regist/mustField.png"> -->
								</div>
							</div>
							<input type="date" class="form-control input-lg" id="birth" name="birth" value="<?=$birth?>" placeholder="">
						</div>
					</div>		
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6 regwd">
								<label for "tel" class="control-label"><font face="標楷體" style="font-size: 15px">聯絡電話（非手機）:</font></label>
<!-- 								<img src="assets/images/regist/mustField.png"> -->
							</div>
						</div>
						<input type="text" class="form-control input-lg" id="tel" name="tel" value="<?=$tel?>" placeholder="">
					</div>
				</div>
				<div class="col-md-1">
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6 regwd">
								<label for "addr" class="control-label"><font face="標楷體" style="font-size: 15px">地址:</font></label>
<!-- 								<img src="assets/images/regist/mustField.png"> -->
							</div>
						</div>
						<input type="text" class="form-control input-lg" id="addr" name="addr" value="<?=$addr?>" placeholder="">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6 regwd">
								<label for "email" class="control-label"><font face="標楷體" style="font-size: 15px">email:</font></label>
<!-- 								<img src="assets/images/regist/mustField.png"> -->
							</div>
						</div>
						<input type="text" class="form-control input-lg" id="email" name="email" value="<?=$email?>" placeholder="">
					</div>
				</div>
				<div class="col-md-1">
				</div>
				<div class="col-md-5">
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6 regwd">
								<label for "verifycode" class="control-label"><font face="標楷體" style="font-size: 15px">請輸入驗證碼:</font></label><br>
							</div>
						</div>
						<input type="text" maxlength="4" size="4"  id="verifycode" name="verifycode" value="" style="height:46px;font-size:18pt;color:black;">
						<img src="<?=WEB_SITE_URL?>ajax/checkCode.php" style="vertical-align: top" id="ckCode">
						<div>
							<a href="javascript:void(0)" onClick="RLoadCK()"><font style="color:gray">重取驗證碼!</font></a>
							<font styel="color:red">(請注意英文字母大小寫!)</font>
						</div>
					</div>
				</div>
				<div class="col-md-1">
				</div>
				<div class="col-md-5">
				</div>
			</div>
			<div class="row">
				<br>
				<div class="col-md-5">
					<div class="text-center">
						<a href="javascript:void(0)" onClick="cEditData()">
							<button type="button" class="btn btn-danger">
								<font face="標楷體" style="font-size: 15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;確認送出&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>
							</button>
						</a>
					</div>
				</div>
				<div class="col-md-1">
				</div>
				<div class="col-md-5">
					<div class="text-center">
						<a href="javascript:void(0)" onClick="cClear()">
							<button type="button" class="btn btn-default">
								<font face="標楷體" style="font-size: 15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;重新填寫&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>
							</button>
						</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	function cClear(){
		document.getElementById("mainForm").reset();
	}
	
	function RLoadCK(){
		d= new Date();
		$('#ckCode').attr("src","<?=WEB_SITE_URL?>ajax/checkCode.php?"+d.getTime());
	}
	function cEditData()
	{
		var tag=false;
		var msg="";
		var name = $.trim($('#name').val());
		var birth = $.trim($('#birth').val());
		var tel = $.trim($('#tel').val());
		var addr = $.trim($('#addr').val());
		var email = $.trim($('#email').val());
		var verifycode=$.trim($('#verifycode').val());
		//var confirmPWD = $.trim($('#confirmPWD').val());
		
		if (name.length>0){
			tag=true;
		}
		if (birth.length>0){
			tag=true;
		}
		if (tel.length>0){
			tag=true;
		}
		if (tel.length>0){
			tag=true;
		}
		if (addr.length>0){
			tag=true;
		}
		if (email.length>0){
			tag=true;
		}
		if (verifycode.length==0){
			tag=false;
			msg=msg.concat(ct,'.驗證碼不可空白;');
			ct=ct+1;
		}
	  	if (tag){
	  		var parameterStr = $('#mainForm').serialize();
			$.ajax({
		   		type: "POST",
		        url: defUrl+"ajax/editData.php",
		        data: parameterStr,
		        dataType:'json',
		        success: function(data) {
		            if(data['code'] == 1){
		            	if (data['desc']!=''){
	                    	alert(data['desc']);
	            		}
		            	document.getElementById("mainForm").reset();
						WebTool.webPageLocation(defUrl.concat("index.php?menuID=1&chpwd=1"));

		            }else{
						if (data['code']==-1){
						    alert('系統忙線中，請稍後再試，感謝您');
						}
						else{
							if (data['code']==32){
								alert(data['desc']);
							}
							else{
								alert('資料格式不正確');
							}
						}
		            }
		        },
		        error:function(xhr, ajaxOptions, thrownError){
		            alert(thrownError);
		 		}
		    });
		}
		else{
			alert(msg);
		}
	    return;
	}
</script>
<?php 
}
?>