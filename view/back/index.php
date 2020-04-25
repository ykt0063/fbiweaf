<?php
use report\tool\RegisterTool;
use report\user\Auth;
use report\user\Session;

//require_once( __DIR__."/common/head.php" );
?>
<!DOCTYPE html>
<html>
<?php 
require_once( __DIR__."/common/head.php" );
//menuID:
//  1: default
//  2: login
//  3: forgetPWD
//  4: changePWD
//  5: 直推圖組織
//  6: 安置組織-立式
//  7: 安置組織圖
//  8: 獎金明細
//  9: 線上購物

if ($menuID==1){
?>
<body onresize="myFunction()">
<?php 
}
else{
?>
<body>
<?php 
}
?>
<script>
	function myFunction() {
<?php
if ($menuID==1){
?>
		if(!isSmartPhone()&& !isTablet()){
		    setTimeout(
		      function() 
		      {
		        //do something special
		        location.reload();
		      }, 50);		
		}
<?php 
}
?>
	}
	function isSmartPhone(){
		var ua=navigator.userAgent;
		if (ua.indexOf('iPhone')>0||(ua.indexOf('Android')>0 && ua.indexOf('Mobile')>0) || ua.indexOf('Windows Phone')>0){
			//alert("Is Smart Phone!!");
			return true;
		}
		else{
			//alert("Is not Smart Phone!!");
			return false;
		}
	}
	function isTablet(){
		var ua=navigator.userAgent;
		if (ua.indexOf('iPad')>0||(ua.indexOf('Android')>0 && ua.indexOf('Mobile')==-1)){
	                //alert("Is Tablet!!");
			return true;
		}
		else{
	                //alert("Is not Tablet!!");
			return false;
		}
	}
	function handler(apID){
    	document.getElementById('menuID').value=apID ;
    	document.getElementById('menuForm').submit();
	};
</script>
<?php 
require_once( __DIR__."/common/menu.php");
require_once( __DIR__."/common/body.php" );
require_once ( __DIR__."/common/hiddenForm.php");
require_once( __DIR__."/common/footer.php" );
?>
</body>
</html>
