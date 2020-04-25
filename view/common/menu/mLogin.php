<?php
use report\user\Session;

include "forLoginScript.php";
?>

<div style="min-height: 420px;">
	<div>
		<div>
			<font style="font-size:30pt">會員登入</font>
		</div>
		<div>
			<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
		</div>
		<div>
			<font style="font-size: 12px">HOME>會員中心><font style="color:red">會員登入</font></font>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-md-5" align="center">
			<br>
			<img src="assets/images/login/content_LOGO.jpg" style="background-color:white; border:2px white solid;">
		</div>
		<div class="col-md-5">
			<form class="form-horizontal"  role="form" id="mainForm" enctype="multipart/form-data" method="post">
				<div class="form-group">
					<label for "account" class="control-label"><font face="標楷體" style="font-size: 15px">帳號(電話號碼):</font></label>
					<input type="text" class="form-control input-lg" id="account" name="account" value="" placeholder="請輸入帳號">
				</div>
				<div class="form-group">
					<label for "password" class="control-label"><font face="標楷體" style="font-size: 15px">密碼:</font></label>
					<input type="password" class="form-control input-lg" id="password" name="password" value="" placeholder="請輸入密碼">
				</div>
				<div>
					<a href="#" onclick="handler('3'); return false;" style="text-decoration:none;"><font face="標楷體" style="font-size:13px;color:red">忘記密碼?</font></a>
<?php 
if (Session::get('payTime')==TRUE){
?>
					<a href="index.php?menuID=pay&reg=1"><font face="標楷體" style="font-size:13px;color:red">&nbsp;&nbsp;註冊</font></a>
<?php 
}
?>
				</div>
				<div class="text-center">
					<a href="javascript:void(0)" onClick="cLogin()">
					<button type="button" class="btn btn-danger">
						<font face="標楷體" style="font-size: 15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;會員登入&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>
					</button>
					</a>
				</div>
			</from>
		</div>
	</div>
</div>
