<?php
//UTF-8編碼
//header('Content-Type: text/html; charset=utf-8');

//設定（※請修改）
$isPC = true; //是否為電腦版（true為電腦版，false為手機版）
$tempvar='00000000000'; //商家自行運用
$returnUrl=WEB_SITE_URL.'payment/receiveStoreData.php'; //回傳位置

//系統參數（勿修改）
$emapURL = ($isPC) ? 'http://emap.shopping7.com.tw/emap/c2cemap.ashx' : 'http://emap.shopping7.com.tw/emap/c2cemapm-u.ashx'; //傳送網址

?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>紅陽 SunTech x EMAP(7-11) DEMO</title>
</head>
<body>
<form id="form1" name="form1" action="<?php echo $emapURL; ?>" method="POST">
    <div>
        <input type="hidden" name="eshopid" value="004"/><!-- 1.固定帶004-->
        <input type="hidden" name="showtype" value="2"/><!--2.固定帶1-->
        <input type="hidden" name="tempvar" value="<?php echo $tempvar; ?>"/><!--3.商家自行運用-->
        <input type="hidden" name="url" value="<?php echo $returnUrl; ?>""/><!--4.回傳位置-->
        <!--5.回傳位置-->
        <input type="submit" name="button" id="button" value="選擇7-11門市"/>
    </div>
</form>
<script>
$(document).ready(function() { 
	$( "#form1" ).submit();
}); 
</script>
</body>
</html>