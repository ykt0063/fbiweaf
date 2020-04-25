<?php
use report\user\Session;
Session::deleteAll();
clearstatcache();
session_unset();

?>
<body>
<script type="text/javascript">
function cLogin()
{
	var account = $.trim($('#account').val());
	var password = $.trim($('#password').val());
	//var verifyCode = $.trim($('#verifyCode').val());
	if(account == ''){
		alert('請输入帳號');
		return;
	}

	if(password == ''){
		alert('請输入密碼');
		return;
	}

// 	if(verifyCode == ''){
// 		alert('请输入驗證码');
// 		return;
// 	}

	var parameterStr = $('#mainForm').serialize();
	$.ajax({
    		type: "POST",
        url: defUrl+"ajax/login.php",
        data: parameterStr,
        dataType:'json',
        success: function(data) {
            if(data['code'] == 1){
            	document.getElementById("mainForm").reset();
            	WebTool.webPageLocation(defUrl+"index.php");
            }else{
				//alert(data['desc']);
				alert('帳號或密碼錯誤,請重新輸入');
            }
        },
        error:function(xhr, ajaxOptions, thrownError){
            alert(thrownError);
 		}
    });

    return;
}
</script>
<div class="container">
	<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="body">
<br><br><br><br><br>
	<div style="background-color:white;border-radius: 25px;">
		<br>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-9"></div>
			<div class="col-md-2 text-center">
				<a href="#" onclick="handler('1'); return false;" style="text-decoration:none;">
					<font style="font-size: 150%">
						<span class="glyphicon glyphicon-remove"></span>
					</font>
				</a>
			</div>
		</div>
		<form class="form-horizontal"  role="form" id="mainForm" enctype="multipart/form-data" method="post">
			<div class="">
				<h1 class="h3 mb-3 font-weight-normal text-center"><font face="標楷體">XXX 用户登錄</font></h1>
			    <h3>
    				<div class="form-group row">
 					   	<label for "account" class="col-md-4 control-label text-right"><font face="標楷體">帳号</font></label>
 		   				<div class="col-md-4">
	    					<input type="text" class="form-control input-lg" id="account" name="account" value="" placeholder="請輸入帳號">
    					</div>
    					<div class="col-md-4ss"></div>
    				</div>
    				<div class="form-group row">
    					<label for "password" class="col-md-4 control-label text-right"><font face="標楷體">密碼</font></label>
    					<div class="col-md-4">
	    					<input type="password" class="form-control input-lg" id="password" name="password" value="" placeholder="請輸入密碼">
    					</div>
       					<div class="col-md-4"></div> 				
    				</div>
    				<div class="form-group row">
    					<div class="col-md-2"></div>
    					<div class="col-md-8">
	    					<div class="col-md-4">
	    						<a href="javascript:void(0)" onClick="cLogin()"><font face="標楷體">立即登錄</font></a>
	    					</div>
	    					<div class="col-md-4">
	    						<a href="/index.php?p1=register"><font face="標楷體">  &nbsp;&nbsp;註冊 &nbsp; &nbsp;</font></a>
	    					</div>
	    					<div class="col-md-4">
	    					<a href="/index.php?p1=forgetpwd"><font face="標楷體">忘記密碼</font></a>
	    					</div>
    					</div>
    					<div class="col-md-2"></div>
    				</div>
    				<br>
    			</h3>	
			</div>
		</form>
	</div>
</div>
	</div>
	<div class="col-md-2"></div>
	</div> 
</div> 