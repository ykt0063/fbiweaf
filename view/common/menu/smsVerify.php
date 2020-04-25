<?php
use report\user\Session;
use report\user\sms;

include "forsmsScript.php";
$bossid=Session::get('smsVerify');
$bossid=Session::get('smsID');
if (isset($g['bID'])){
    $bossid=$g['bID'];
    $session=array('smsID'=>$bossid);
    Session::save($session);
}

$tag=false;
$inputTag="disabled";
$sendTag='';
//if ((isset($g['iTag'])&&($g['iTag']==1))){
    $inputTag='';
//    $sendTag="disabled";
    //$verifyCode=bin2hex(random_bytes(3));//驗證碼設為六位數
    $tmpCode=random_int(0,9999).'';
    $verifyCode=str_repeat('0',(4-strlen($tmpCode))).$tmpCode;
    $ret=sms::sendOneMessage($bossid,$verifyCode);
//}

if ($bossid!=''){
    $tag=true;
}
?>
<script>alert("已發送簡訊-驗證碼");</script>
<div style="min-height: 420px;">
	<div>
		<div>
			<font style="font-size:30pt">會員簡訊驗證</font>
		</div>
		<div>
			<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
		</div>
		<div>
			<font style="font-size: 12px">HOME>會員中心><font style="color:red">會員簡訊驗證</font></font>
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
					<input type="text" class="form-control input-lg" id="account" name="account" value="<?=$bossid?>" placeholder="請輸入帳號" readonly="readonly" >
				</div>
				<div class="form-group">
					<label for "smsVerifyCode" class="control-label"><font face="標楷體" style="font-size: 15px">驗證碼:</font></label>
					<input type="text" class="form-control input-lg" id="smsVerifyCode" name="smsVerifyCode" value="" placeholder="請輸入驗證碼" <?=$inputTag?>>
				</div>
				<div>
					<a href="<?=WEB_SITE_URL?>?menuID=smsVerify&iTag=1"><font face="標楷體" style="font-size:13px;color:red" <?=$sendTag?>>傳送驗證碼?</font></a>
				</div>
				<div class="text-center">
					<a href="javascript:void(0)" onClick="cVerify()">
					<button type="button" class="btn btn-danger" <?=$inputTag?>>
						<font face="標楷體" style="font-size: 15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;會員登入&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>
					</button>
					</a>
				</div>
			</from>
		</div>
	</div>
</div>
