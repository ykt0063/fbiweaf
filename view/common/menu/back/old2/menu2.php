<?php 
use report\user\Session;
$account='';
if (null!=SESSION::get('account')){
    $account=SESSION::get('account');
}
?>
<script type="text/javascript">
$(function () {
});

function cChangePWD()
{
	var account = $.trim($('#account').val());
	var oldpassword = $.trim($('#oldpassword').val());
	var newpassword = $.trim($('#newpassword').val());
	//var verifyCode = $.trim($('#verifyCode').val());
	if(oldpassword == ''){
		alert('請輸入舊密码');
		return;
	}
	if(newpassword == ''){
		alert('請輸入新密码');
		return;
	}

// 	if(verifyCode == ''){
// 		alert('请输入驗證码');
// 		return;
// 	}

	var parameterStr = $('#mainForm-CPW').serialize();
	$.ajax({
    		type: "POST",
        url: defUrl+"ajax/changepwd.php",
        data: parameterStr,
        dataType:'json',
        success: function(data) {
            if(data['code'] == 1){
            		//WebTool.webPageLocation(defUrl+"index.php");
				alert('密碼已更新,請重新登入');
				WebTool.webPageLocation(defUrl+"index.php?p1=logout");
            }else{
							//alert(data['desc']);
					alert('輸入密碼有問題,請重新輸入');
            }
        },
        error:function(xhr, ajaxOptions, thrownError){
            alert(thrownError);
 		}
    });

    return;
}
</script>
<div align="left">
<h4>
<form role="form" class="form-horizontal" id="mainForm-CPW" enctype="multipart/form-data" method="post">
	<div class='row'>
		<h3 class="h3 col-md-offset-4 col-md-3"><p><font face="標楷體"><B>變更密碼</B></font></p></h3>
	</div>
	<div class='row'>
    	<div class="col-md-offset-4 col-md-3"><p><font face="標楷體">帳號</font>:<?php echo $account; ?><input type="hidden" id="account" name="account" value="<?php echo $account;?>"></p></div>
    </div>
    <div class='row'>
	    <div class="col-md-offset-4 col-md-3"><p><font face="標楷體">舊密码</font>:<input type="password" id="oldpassword" name="oldpassword" value="" placeholder="請輸入舊密码"></p></div><br>
    </div>
    <div class='row'>
	    <div class="col-md-offset-4 col-md-3"><p><font face="標楷體">新密码</font>:<input type="password" id="newpassword" name="newpassword" value="" placeholder="請輸入新密码"></p></div>
	</div>
</form>
<div class="ChangePWD col-md-offset-4 col-md-3"><a href="javascript:void(0)" onClick="cChangePWD()"><font face="標楷體">立即更改</font></a></div>
</h4>
</div>
