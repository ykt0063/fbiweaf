<p id='tagForSC'></p>
<script>
var x =  $( window ).width();
var str1="<div class='row affix-row'>\n";
str1=str1+"	<div class='col-md-5-cols affix-sidebar'>\n";
str1=str1+"		<div id='memberNav'>\n";
str1=str1+"			<div class='sidebar-nav'>\n";
str1=str1+"  				<div class='navbar navbar-default' role='navigation'>\n";
str1=str1+"    				<div class='navbar-header'>\n";
str1=str1+"      					<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.sidebar-navbar-collapse'>\n";
str1=str1+"					    	<span class='sr-only'>Toggle navigation</span>\n";
str1=str1+"      						<span class='icon-bar'></span>\n";
str1=str1+"      						<span class='icon-bar'></span>\n";
str1=str1+"      						<span class='icon-bar'></span>\n";
str1=str1+"      					</button>\n";
str1=str1+"      					<span class='visible-xs navbar-brand'>成泰生物科技有限公司</span>\n";
str1=str1+"    				</div>\n";
str1=str1+"    				<div class='navbar-collapse collapse sidebar-navbar-collapse'>\n";
str1=str1+"      					<ul class='nav navbar-nav' id='sidenav01'>\n";
<?php
use report\user\Auth;
if (!Auth::isLogin()){
?>
str1=str1+"                        	<li style='width:100%'><a href='#' onclick=\"handler('1'); return false;\" style='text-decoration:none;'><span class='glyphicon glyphicon-log-in'></span> 會員登入</a></li>\n";
str1=str1+"        					<li style='width:100%'><a href='#' onclick=\"handler('2'); return false;\" style='text-decoration:none;'><span class='glyphicon glyphicon-registration-mark'></span> 會員註冊</a></li>\n";
str1=str1+"        					<li style='width:100%'><a href='#' onclick=\"handler('3'); return false;\" style='text-decoration:none;'><span class='glyphicon glyphicon-cog'></span> 忘記密碼</a></li>\n";
str1=str1+"        					<li style='width:100%'><a href='#' onclick=\"handler0('1'); return false;\" style='text-decoration:none;'><span class='glyphicon glyphicon-th-list'></span> 商品介紹</a></li>\n";
str1=str1+"        					<li style='width:100%'><a href='#' onclick=\"handler('sc'); return false;\" style='text-decoration:none;'><span class='glyphicon glyphicon-shopping-cart'></span>購物車</a></li>\n";
<?php 
}
else{
?>
str1=str1+"      					<li style='width:100%'><a href='#' onclick=\"handler('4'); return false;\" style='text-decoration:none;'><span class='glyphicon glyphicon-log-out'></span> 登出</a></li>\n";					
str1=str1+"        					<li style='width:100%'><a href='#' onclick=\"handler0('1'); return false;\" style='text-decoration:none;'><span class='glyphicon glyphicon-th-list'></span> 商品介紹</a></li>\n";
str1=str1+"        					<li style='width:100%'><a href='#' onclick=\"handler('sc'); return false;\" style='text-decoration:none;'><span class='glyphicon glyphicon-shopping-cart'></span> 購物車</a></li>\n";
<?php 
}
?>
str1=str1+"        				</ul>\n";
str1=str1+"      			</div>\n";
str1=str1+"    			</div>\n";
str1=str1+"			</div>\n";			
str1=str1+"		</div>\n";
str1=str1+"	</div>\n";
str1=str1+"</div>\n";
if (x<757){
	document.getElementById("tagForSC").innerHTML = str1;
}
</script>
