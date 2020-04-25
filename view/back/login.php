<?php
//use report\system\Web;
use report\user\Session;

require_once( __DIR__."/../init.inc.php" );
require_once( __DIR__."/common/head.php" );
Session::deleteAll();
clearstatcache();
session_unset();
//session_destroy();
?>
<body>
<script type="text/javascript">
$(function () {
});
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
<!-- 
<div class="header col-md-offset-2 col-md-10 control" >
	<h2><font face="標楷體">用户登錄</font></h2 >
</div>
 -->
 <div class="container">
 <div id="head_bg" align="center">
          <img src="/assets/images/logo.jpg" alt="XXX有限公司" id="logo" class="img-responsive">
 </div>
<div class="body">
<form class="form-horizontal"  role="form" id="mainForm" enctype="multipart/form-data" method="post"">
	<h1 class="h3 mb-3 font-weight-normal"><font face="標楷體">XXX 用户登錄</font></h1>
    <h3>
    <div class="form-group">
    	<label for "account" class="col-md-3 control-label"><font face="標楷體">帳号</font></label>
    	<div class="col-md-9">
	    	<input type="text" class="form-control input-lg" id="account" name="account" value="" placeholder="請輸入帳號">
    	</div>
    </div>
    <div class="form-group">
    	<label for "password" class="col-md-3 control-label"><font face="標楷體">密碼</font></label>
    	<div class="col-md-9">
	    	<input type="password" class="form-control input-lg" id="password" name="password" value="" placeholder="請輸入密碼">
    	</div>
    </div>
    <div class="form-group">
	    <div class="col-sm-6">
	    	<a href="javascript:void(0)" onClick="cLogin()"><font face="標楷體">立即登錄</font></a>
	    </div>
	    <div class="col-sm-6">
	    	<a href="/index.php?p1=register"><font face="標楷體">註冊</font></a>
	    </div>
    </div>
    </h3>
    
</form>
</div>
</div>
<?php 
require_once( __DIR__."/common/footer.php" );
?>
