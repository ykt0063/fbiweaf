<?php

use report\user\Session;

?>
<script>
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
//	    if(verifyCode == ''){
//	        alert('请输入驗證码');
//	        return;
//	    }
    var parameterStr = $('#mainForm').serialize();
    $.ajax({
        type: "POST",
	    url: defUrl+"ajax/login.php",
	    data: parameterStr,
	    dataType:'json',
	    success: function(data) {
        	if(data['code'] == 1){
            	if (data['desc']!=''){
                    	alert(data['desc']);
            	}
        		document.getElementById("mainForm").reset();
    		    //WebTool.webPageLocation(defUrl+"index.php");
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