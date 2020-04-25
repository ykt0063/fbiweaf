<?php

use report\user\Session;
$a=0;
if (($name!='')&&($checkCode!='')){
    //$intro='推薦人-'.$name;
    $intro='';
    $introValue=$checkCode;
    $introTag='';
}
else{
    $intro='';
    $introValue='';
    $introTag='disabled';
}
    ?>
<div style="min-height: 700px;  color: black;">
	<div>
		<div>
			<font style="font-size:30pt;">會員註冊<?=$intro?></font>
		</div>
		<div>
			<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
		</div>
		<div>
			<font style="font-size: 12px">HOME>會員中心><font style="color:red">會員註冊</font></font>
		</div>
	</div>
	<div class="text-center">
		<img src="assets/images/regist/mustField.png"><font style="color:red;font-size:14pt">請確認您的必填項目皆已完整填寫</font>
	</div>
	<br>
	<div>
		<form class="form-horizontal"  role="form" id="mainForm" enctype="multipart/form-data" method="post">
			<input type="hidden" class="form-control input-lg" id="address" name="address" value="" placeholder="請輸入聯絡地址">
			<input type="hidden" class="form-control input-lg" id="telephone" name="telephone" value="" placeholder="請輸入聯絡電話">
			<input type="hidden" class="form-control input-lg" id="trueIntroNo" name="trueIntroNo" value="<?=$introValue?>" placeholder="請輸入推薦人代碼" <?=$introTag?>>
			<input type="hidden" name="sex" value=1>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6 regwd">
								<label for "account" class="control-label"><font face="標楷體" style="font-size: 15px">手機號碼:</font></label>
								<img src="assets/images/regist/mustField.png">
							</div>
						</div>
						<input type="text" class="form-control input-lg" id="account" name="account" value="" placeholder="請輸入帳號">
					</div>
				</div>
				<div class="col-md-1">
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6 regwd">
								<label for "name" class="control-label"><font face="標楷體" style="font-size: 15px">真實姓名:</font></label>
								<img src="assets/images/regist/mustField.png">
							</div>
						</div>
						<input type="text" class="form-control input-lg" id="name" name="name" value="" placeholder="請輸入真實姓名">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6 regwd">
								<label for "password" class="control-label"><font face="標楷體" style="font-size: 15px">密碼:</font></label>
<!-- 								<img src="assets/images/regist/mustField.png"> -->
							</div>
						</div>
						<input type="password" class="form-control input-lg" id="password" name="password" value="" placeholder="密碼空白者，預設為手機號碼末4碼">
					</div>
				</div>
				<div class="col-md-1">
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6 regwd">
								<label for "birth" class="control-label"><font face="標楷體" style="font-size: 15px">出生日期:</font><font face="標楷體" style="font-size: 12px"> 贈送生日禮金用</font></label>
							</div>
						</div>
						<div class="birthDate">
							<input class="form-control input-lg" type="text" maxlength="8" size="8" value="" id="birth" name="birth" style="height: 46px;" placeholder="前四碼西元年兩碼月份兩碼日期">
						</div>
					</div>
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
				<div class="col-md-5">
					<div class="form-group">
						<div class="row">
						<div class="col-md-6 regwd">
							請閱讀網站隱私權<input name="readPrivacy" type="checkbox" id="readPrivacy" onclick="forPrivacy()" style="transform : scale(1.5);width:15pt;">
						</div>
						</div>
						<div class="row">
						<div class="col-md-6 regwd">
							請閱讀會員權益<input name="readMRight" type="checkbox" id="readMRight" onclick="memberRight(true)" style="transform : scale(1.5);width:15pt;">
						</div>
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
						<a href="javascript:void(0)" onClick="ccRegistData()">
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
	function checkBossID( id ) {
	  tab = "ABCDEFGHJKLMNPQRSTUVXYWZIO"                     
	  A1 = new Array (1,1,1,1,1,1,1,1,1,1,2,2,2,2,2,2,2,2,2,2,3,3,3,3,3,3 );
	  A2 = new Array (0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5 );
	  Mx = new Array (9,8,7,6,5,4,3,2,1,1);

	  if ( id.length != 10 ) return false;
	  i = tab.indexOf( id.charAt(0) );
	  if ( i == -1 ) return false;
	  sum = A1[i] + A2[i]*9;

	  for ( i=1; i<10; i++ ) {
	    v = parseInt( id.charAt(i) );
	    if ( isNaN(v) ) return false;
	    sum = sum + v * Mx[i];
	  }
	  if ( sum % 10 != 0 ) return false;
	  return true;
	}

	function checkID(){
		var bossId = $.trim($('#bossId').val());
		var $radios = $('input:radio[name=idKind]');
		if (bossId.length==10){
			if (checkBossID(bossId)){
	    	    $radios.filter('[value=1]').prop('checked', true);
			}
			else{
				alert('身份證號欄位輸入錯誤');
			}
		}
		else{
			$radios.filter('[value=2]').prop('checked', true);
		}
	}
	
	function isValidDate(dateString){
		// First check for the pattern
	    if(!/^\d{4}\-\d{1,2}\-\d{1,2}$/.test(dateString))
	        return false;
	
	    // Parse the date parts to integers
	    var parts = dateString.split("-");
	    var day = parseInt(parts[2], 10);
	    var month = parseInt(parts[1], 10);
	    var year = parseInt(parts[0], 10);
	
	    // Check the ranges of month and year
	    if(year < 1000 || year > 3000 || month == 0 || month > 12)
	        return false;
	
	    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];
	
	    // Adjust for leap years
	    if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
	        monthLength[1] = 29;
	
	    // Check the range of the day
	    return day > 0 && day <= monthLength[month - 1];
	}
	
	function RLoadCK(){
		d= new Date();
		$('#ckCode').attr("src","<?=WEB_SITE_URL?>ajax/checkCode.php?"+d.getTime());
	}
	function ccRegistData()
	{
		var tag=true;
		var msg="";
		var mbName = $.trim($('#name').val());
		var bossId = $.trim($('#account').val());
		var password = $.trim($('#password').val());
		//var confirmPWD = $.trim($('#confirmPWD').val());
		var sex = $.trim($('#sex').val());
		var birth = $.trim($('#birth').val());
		var tel = $.trim($('#telephone').val());
		//var mtel = $.trim($('#mobilePhone').val());
		var address = $.trim($('#address').val());
		//var trueIntroName = $.trim($('#trueIntroName').val());
		var trueIntroNo = $.trim($('#trueIntroNo').val());
		var ct=1;
		if (mbName.length==0){
			tag=false;
			msg=msg.concat(ct,'.會員名稱不可空白;');
			ct=ct+1;
		}
		if (bossId.length==0){
			tag=false;
			msg=msg.concat(ct,'.手機號碼不可空白;');
			ct=ct+1;
		}
		else{
			if(bossId.length != 10){
// 				if (!checkBossID(bossId)){
// 					tag=false;
// 					msg=msg.concat(ct,'.手機號碼格式錯誤;');
// 					ct=ct+1;
// 				}
				tag=false;
				msg=msg.concat(ct,'.手機號碼格式錯誤;');
				ct=ct+1;
			}
// 			else{
// 				if(bossId.length!=8){//非公司統編
// 					tag=false;
// 					msg=msg.concat(ct,'.身份證號格式錯誤;');
// 					ct=ct+1;
// 				}
// 			}
		}
		if (birth.length==0){
// 			tag=false;
// 			msg=msg.concat(ct,'.生日不可空白;');
// 			ct=ct+1;
		}
		else{
			year=birth.substr(0,4);
			month=birth.substr(4,2);
			day=birth.substr(6,2);
			birth=year+"-"+month+"-"+day;
			if (!isValidDate(birth)){
				tag=false;
				msg=msg.concat(ct,'.生日格式錯誤;');
				ct=ct+1;
			}
		}
	  	if (tag){
	  		var r=document.getElementById("readMRight");
			var p=document.getElementById("readPrivacy");
			if ((r.checked == true)&&(p.checked == true)){
		  		var parameterStr = $('#mainForm').serialize();
				$.ajax({
			   		type: "POST",
			        url: defUrl+"ajax/checkRegist.php",
			        data: parameterStr,
			        dataType:'json',
			        success: function(data) {
			            if(data['code'] == 1){
			            	document.getElementById("mainForm").reset();
							WebTool.webPageLocation(defUrl.concat("index.php?menuID=smsVerify"));

			            }else{
							if (data['code']==-1){
							    alert('系統忙線中，請稍後再試，感謝您');
							}
							else{
								if (data['code']==32){
									alert(data['desc']);
								}
								else{
									alert('電話號碼已註冊，請與系統人員聯絡，感謝您');
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
				alert("請先閱讀會員權益與網站隱私權！！！");
			}
		}
		else{
			alert(msg);
		}
	    return;
	}
</script>
<?php include "forMemberRight.php";?>