<?php

use report\organization\Personal;
use report\user\Session;
$account='';
// $listA=array();
$str='';
?>
<div style="min-height: 700px;  color: black;">
	<div>
		<div>
			<font style="font-size:30pt;">忘記密碼</font>
		</div>
		<div>
			<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
		</div>
		<div>
			<font style="font-size: 12px">HOME>會員中心><font style="color:red"> 忘記密碼</font></font>
		</div>
	</div>
	<br>
	<div>
		<form class="form-horizontal"  role="form" id="mainForm" enctype="multipart/form-data" method="post">
			<div class="form-group">
				<div class="col-md-5">
					<div class="row">							
						<div class="col-md-6 regwd">
							<label for "account" class="control-label"><font face="標楷體" style="font-size: 15px">帳號:</font></label>
							<img src="assets/images/regist/mustField.png">
						</div>
					</div>
					<input type="text" class="form-control input-lg" id="account" name="account" value="" placeholder="請輸入帳號">
				</div>
				<div class="col-md-1">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-5">
					<div class="row">
						<div class="col-md-6 regwd">
							<label for "idKind" class="control-label" style="text-align: left"><font face="標楷體" style="font-size: 15px">確認方式</font></label>
							<img src="assets/images/regist/mustField.png">
						</div>
					</div>
					<div class="radio">
  						<label><input type="radio" name="identifyWay" value=1 checked="checked">簡訊</label>
  						<!--<label><input type="radio" name="identifyWay" value=2>email</label>-->
					</div>
				</div>
				<div class="col-md-1">
				</div>
			</div>
			<div id='identifyArea'>
				<div class="form-group">
					<div class="col-md-5">
						<div class="row">
							<div class="col-md-6 regwd">
								<label for "name" class="control-label"><font face="標楷體" style="font-size: 15px">姓名:</font></label>
								<img src="assets/images/regist/mustField.png">
							</div>
						</div>
						<input type="text" class="form-control input-lg" id="name" name="name" value="" placeholder="請輸入帳號持有人的中文姓名">
					</div>
					<div class="col-md-1">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-5">
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
				<div class="col-md-1">
				</div>
				<div class="col-md-5">
				</div>
			</div>
			<div class="row">
				<br>
				<div class="col-md-5">
					<div class="text-center">
						<a href="javascript:void(0)" onClick="cForgetPWD()">
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
	$( document ).ready(function() {
		$('input[type=radio][name=identifyWay]').change(function(){
			var str="";
			if (this.value == 1) {//sms
				str=str+"				<div class=\"form-group\">\n";
				str=str+"					<div class=\"col-md-5\">\n";
				str=str+"						<div class=\"row\">\n";
				str=str+"							<div class=\"col-md-6 regwd\">\n";
				str=str+"								<label for \"name\" class=\"control-label\"><font face=\"標楷體\" style=\"font-size: 15px\">姓名:</font></label>\n";
				str=str+"								<img src=\"assets/images/regist/mustField.png\">\n";
				str=str+"							</div>\n";
				str=str+"						</div>\n";
				str=str+"						<input type=\"text\" class=\"form-control input-lg\" id=\"name\" name=\"name\" value=\"\" placeholder=\"請輸入帳號持有人的中文姓名\">\n";
				str=str+"					</div>\n";
				str=str+"					<div class=\"col-md-1\">\n";
				str=str+"						<input type=\"hidden\" class=\"form-control input-lg\" id=\"email\" name=\"email\" value=\"\">\n";
				str=str+"					</div>\n";
				str=str+"				</div>";
			}
			else{//email
				str=str+"				<div class=\"form-group\">\n";
				str=str+"					<div class=\"col-md-5\">\n";
				str=str+"						<div class=\"row\">\n";
				str=str+"							<div class=\"col-md-6 regwd\">\n";
				str=str+"								<label for \"email\" class=\"control-label\"><font face=\"標楷體\" style=\"font-size: 15px\">email:</font></label>\n";
				str=str+"								<img src=\"assets/images/regist/mustField.png\">\n";
				str=str+"							</div>\n";
				str=str+"						</div>\n";
				str=str+"						<input type=\"text\" class=\"form-control input-lg\" id=\"email\" name=\"email\" value=\"\" placeholder=\"請輸入email address!\">\n";
				str=str+"					</div>\n";
				str=str+"					<div class=\"col-md-1\">\n";
				str=str+"						<input type=\"hidden\" class=\"form-control input-lg\" id=\"name\" name=\"name\" value=\"\">\n";
				str=str+"					</div>\n";
				str=str+"				</div>";
			}
			$('#identifyArea').html(str);
		});
	});
	function cClear(){
		document.getElementById("mainForm").reset();
	}
	
	function RLoadCK(){
		d= new Date();
		$('#ckCode').attr("src","<?=WEB_SITE_URL?>ajax/checkCode.php?"+d.getTime());
	}
	function cForgetPWD()
	{
		var tag=true;
		var msg="";
		var account = $.trim($('#account').val());
		var name = $.trim($('#name').val());
		var email = $.trim($('#email').val());
		var idway =$("input[name='identifyWay']:checked").val();
		var verifycode=$.trim($('#verifycode').val());
		//var confirmPWD = $.trim($('#confirmPWD').val());
		var ct=0;
		if (account.length==0){
			tag=false;
			msg=msg.concat(ct,'.帳號不可空白;');
			ct=ct+1;
		}
		if (idway=='1' && name.length==0){
			tag=false;
			msg=msg.concat(ct,'.姓名不可空白;');
			ct=ct+1;
		}
		if (idway=='2' && email.length==0){
			tag=false;
			msg=msg.concat(ct,'.email不可空白;');
			ct=ct+1;
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
		        url: defUrl+"ajax/forgetPWD.php",
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
								alert('帳號不存在');
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
