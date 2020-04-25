<?php

use report\user\Session;

?>
<script>
function cVerify()
{
	var account = $.trim($('#account').val());
    var password = $.trim($('#smsVerifyCode').val());
    //var verifyCode = $.trim($('#verifyCode').val());
    if(account == ''){
         alert('請输入帳號');
         return;
    }
	    if(password == ''){
            alert('請输入驗證碼');
            return;
    }
//	    if(verifyCode == ''){
//	        alert('请输入驗證码');
//	        return;
//	    }
    var parameterStr = $('#mainForm').serialize();
    $.ajax({
        type: "POST",
	    url: defUrl+"ajax/checkVerifyCode.php",
	    data: parameterStr,
	    dataType:'json',
	    success: function(data) {
        	if(data['code'] == 1){
        		alert('歡迎加入玩美勁化會員，您有300元的購物金可在本站使用。');
        		document.getElementById("mainForm").reset();
    		    WebTool.webPageLocation(defUrl+"index.php");
<?php 
if (Session::get('payTime')==TRUE){
?>
				WebTool.webPageLocation(defUrl+"index.php?menuID=pay");
<?php
}
else{
?>
		   		WebTool.webPageLocation(defUrl+"index.php");
<?php
}
?>
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