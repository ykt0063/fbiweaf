<?php

use report\order\Products;
use report\user\Session;
use report\user\Auth;

$resp=Products::getgetProductActivityLimitTime();//spec
//echo "<!-- resp=".$resp['code']." -->";
if ($resp['code']==0){
    $data=$resp['data'];
    foreach($data as $row){
        $limitTimeBegin= $row['beginDate'];
        $limitTimeEnd= $row['endDate'];
    }
    //$data->close();
    $timestamp = strtotime($limitTimeBegin);
    $limitTimeBeginStr=date("m/d H:i", $timestamp);
    $timeStr=date("D M d Y H:i:s", $timestamp);
    $timestamp = strtotime($limitTimeEnd);
    $limitTimeEndStr=date("m/d H:i", $timestamp);
}
else{
    $timeStr=date("m/d H:i",strtotime("now"));
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>玩美勁化</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  
  <link rel="stylesheet" href="<?=WEB_ASSET_URL?>css/bootstrap.min.css">
  
  <script src="<?=WEB_ASSET_URL?>js/bootstrap.min.js"></script>
  <link href="<?=WEB_ASSET_URL?>css/style.css" rel="stylesheet" type="text/css">

  <link href="<?=WEB_ASSET_URL?>css/timeTo.css" type="text/css" rel="stylesheet"/>
  <script src="<?=WEB_ASSET_URL?>js/jquery.time-to.js"></script>
  
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script src="assets/js/tool.js"></script>
<?php 
if ($mid==0){
    if ($mainID==1){
        $prodID = isset($g['prodID'])?$g['prodID']:'0';
        echo "<!-- prodID=$prodID-->\n";
        if ($prodID=='a'){
?>
  <script src="<?=WEB_ASSET_URL?>js/mlens.js"></script>
<?php 
        }
    }
}   
if ($mid==7){
?>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php 
}
if ($mid==6||$mid==8){
?>
<link rel="stylesheet" href="<?=WEB_ASSET_URL?>dist/themes/default/style.css" />
<script src="<?=WEB_ASSET_URL?>js/jstree.min.js"></script>
<?php 
}
?>
  <script>
  	
  	$(function(){ 
  	     var navMain = $(".navbar-collapse"); // avoid dependency on #id
  	     // "a:not([data-toggle])" - to avoid issues caused
  	     // when you have dropdown inside navbar
  	     var x = $( window ).width();
         if (x<767){
  	     	navMain.on("click", "a:not([data-toggle])", null, function () {
  	        	 navMain.collapse('hide');
  	     	});
         }
  	 });
  	var defUrl = "<?=WEB_SITE_URL?>";
    $( document ).ready(function() {
        if (!$('#WRAPPER').hasClass('isgift')) {
        	$(window).on('scroll', function() {
        	    if ($(this).width() <= 1280) {
        	        $('#toolbar').css({
        	            //top: $(this).scrollTop() + ($(this).height() - $('#toolbar').height()) / 2 - 8
        	        });
        	    } else {
        	        $('#toolbar').removeAttr('style');
        	    }
        	}).trigger('scroll');
    	}

        var x = $( window ).width();
        if ((x<757)||(isSmartPhone())){
        	//setMenu();
        	
        	$('#navHeader').html('');
        	$('#divHr').html('');
//         	$('.birthDate').html('<input type="date" name="birth" id="birth">');
        	$('.layout-east').html('');
        	$('#footend1').css('padding-left','10%');
        	//$('#myNavUl').append(str);
        	$('.regwd').css('padding-left', '30px');
        	$('.prodName').css('height', '80px');
        }
        else{
//         	setProdMenu();
             document.getElementById("forBrTag").innerHTML = "<br>\n";
			 $('#headerID').addClass('text-center');
        	 if (x<992){
             	$('#footend1').css('padding-left','10%');
             }
             else{
             	$('#footend1').css('padding-left','15%');
             }
        }
        $(window).trigger('scroll');
        $(window).bind('scroll', function () {
            var pixels = 100; //number of pixels before modifying styles
            if ($(window).scrollTop() > pixels) {
                $('#nav-button').addClass('navbar-fixed-top');
            } else {
                $('#nav-button').removeClass('navbar-fixed-top');
            }
        }); 
        $('#countdown').timeTo({timeTo: new Date(new Date('<?=$timeStr?> GMT+0800 (CST)')),
            displayDays: 2,
            theme: "white",
            displayCaptions: false,
            fontSize: 24,
            captionSize: 14}); 
        
<?php 
if (!empty(Session::get('tmpMBNO'))){
    $account= Session::get('tmpMBNO');
    $msg="您的帳號是 ".$account." 請使用新帳號登入";
?>
		alert('<?=$msg?>');
<?php 
    Session::delete('tmpMBNO');
}
$scLinkTag="onclick='return false;'";
if ($kindNumber>0){
    $scLinkTag="onclick=\"handler('sc'); return false;\"";
?>
		$('.scNumber').html('(<?=$kindNumber?>)');
		$('#scIDTAG').css({"font-weight":"900"});
<?php 
}
if ($mid=='2'){
    $checkCode=isset($g['ckc'])?$g['ckc']:'';
    $name=isset($g['n'])?$g['n']:'';
}
if ($mid=='pay'){
?>
		$('#sameAsOder').change(function(){
			if($(this).prop('checked')) {
				$orderName=$('#orderName').val();
				$orderTel=$('#orderTel').val();
				$orderMtel=$('#orderMtel').val();
				$orderAddr=$('#orderAddr').val();
				$('#toName').val($orderName);
				$('#toTel').val($orderTel);
				$('#toMtel').val($orderMtel);
				$('#toAddr').val($orderAddr);
			}
			else{
				$('#toName').val('');
				$('#toTel').val('');
				$('#toMtel').val('');
				$('#toAddr').val('');
			}
		});
<?php 
}
?>
  	});
    function handler(apID){
    	document.getElementById('menuID').value=apID ;
    	document.getElementById('mainID').value=0 ;
//    	document.getElementById('menuForm').submit();
    	$("#menuForm").prop('target', '_self').submit();
    };
    function handler0(apID){
    	document.getElementById('menuID').value=0 ;
    	document.getElementById('mainID').value=apID ;
//    	document.getElementById('menuForm').submit();
    	$("#menuForm").prop('target', '_self').submit();
    };
    function handlerProd(apID){
    	document.getElementById('menuID').value=0 ;
    	document.getElementById('mainID').value=1 ;
    	document.getElementById('prodID').value=apID ;
//    	document.getElementById('menuForm').submit();
    	$("#menuForm").prop('target', '_self').submit();
    };
    function handlerProduct(apID,prodID){
    	document.getElementById('menuID').value=0 ;
    	document.getElementById('mainID').value=1 ;
    	document.getElementById('prodID').value=apID ;
    	document.getElementById('productID').value=prodID ;
//    	document.getElementById('menuForm').submit();
    	$("#menuForm").prop('target', '_self').submit();
    };
    function handlerActive(mainID){
    	document.getElementById('menuID').value=0 ;
    	document.getElementById('mainID').value=mainID ;
//     	document.getElementById('menuForm').submit();
    	$("#menuForm").prop('target', '_self').submit();
    };
    function handlerOrg(apID,acc){
    	document.getElementById('menuID').value=apID ;
    	document.getElementById('mainID').value=0 ;
    	document.getElementById('acno').value=acc ;
    	$("#menuForm").prop('target', '_self').submit();
    	//document.getElementById('menuForm').submit();
    };
    function handlerSingleForm(ordNo){
    	document.getElementById('menuID').value=-1 ;
    	document.getElementById('ordno').value=ordNo ;
    	$("#menuForm").prop('target', '_blank').submit();
    };
    function setMenu(){
        var str1="<nav id='nav-button' class='navbar navbar-inverse navbar-static-top navbar-lower'>\n";
        str1=str1+"	<div class='container-fluid'>\n";
        str1=str1+"		<div class='navbar-header'>\n";          
        str1=str1+"			<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#myNavbar' aria-expanded='false'> <span class='sr-only'>Toggle navigation</span>\n";
        str1=str1+"				<span class='icon-bar'></span>\n";
        str1=str1+"				<span class='icon-bar'></span>\n";
        str1=str1+"				<span class='icon-bar'></span>\n";
        str1=str1+"			</button>\n";
        str1=str1+"		</div>\n";

        str1=str1+"\n    <div class=\"navbar-collapse collapse sidebar-navbar-collapse\" id=\"myNavbar\" style=\"border-color: white;\">\n";
        str1=str1+"      <ul class=\"nav navbar-nav\" id=\"myNavUl\">\n";
<?php 
if (!Auth::isLogin()){
?>
        str1=str1+"        <li><a href=\"#\" onclick=\"handler('1'); return false;\" style=\"text-decoration:none;\"><font style=\"font-size:14px\">會員登入</font></a></li>\n";
<?php 
}
else{
?>
		str1=str1+"         <li><font style=\"color:white;\">歡迎&nbsp;<?php echo Session::get('name'); ?>&nbsp;登入</font></li>\n";
<?php 
}
$tab1="&nbsp;&nbsp;";
$tab2="&nbsp;&nbsp;&nbsp;&nbsp;";
$prodID = isset($g['prodID'])?$g['prodID']:'0';
?>
        str1=str1+"        <li><a class='' data-toggle='collapse' data-target='#sidenav1' data-parent='#myNavUl'  href='#'><font style='font-size:14px'>商品介紹</font></a>\n";
        str1=str1+"            <ul class='dropdown-menu' id='sidenav1'>\n";
        str1=str1+"                <li style='width:100%'>\n";
        str1=str1+"                    <a href='#' data-toggle='collapse' data-target='#toggleDemoA' data-parent='#sidenav1' class='collapsed'>美妝<span class='caret'></span></a>\n";
        str1=str1+"                    <div class='collapse' id='toggleDemoA' style='height: 0px;'>\n";
        str1=str1+"                        <ul class='nav nav-list' id='sidenav1a'>\n";
        str1=str1+"                            <li style='width:100%'>\n";
        str1=str1+"                                <a href='#' data-toggle='collapse' data-target='#toggleDemoA' data-parent='#sidenav1a' class='collapsed'><?=$tab1?>臉部保護<span class='caret'></span></a>\n";
        str1=str1+"                                <div class='collapse' id='toggleDemoA' style='height: 0px;'>\n";
        str1=str1+"                                    <ul class='nav nav-list'>\n";
        str1=str1+"                                        <li style='width:100%'><a href='#' onclick=\"handlerProd('AA01'); return false;\" style='text-decoration:none;'><?=$tab2?>面膜</a></li>\n";
        str1=str1+"                                        <li style='width:100%'><a href='#' onclick=\"handlerProd('AA02'); return false;\" style='text-decoration:none;'><?=$tab2?>卸妝</a></li>\n";
        str1=str1+"                                        <li style='width:100%'><a href='#' onclick=\"handlerProd('AA03'); return false;\" style='text-decoration:none;'><?=$tab2?>化妝水</a></li>\n";
        str1=str1+"                                        <li style='width:100%'><a href='#' onclick=\"handlerProd('AA04'); return false;\" style='text-decoration:none;'><?=$tab2?>精華液/安瓶</a></li>\n";
        str1=str1+"                                        <li style='width:100%'><a href='#' onclick=\"handlerProd('AA05'); return false;\" style='text-decoration:none;'><?=$tab2?>凝膠/凝凍</a></li>\n";
        str1=str1+"                                        <li style='width:100%'><a href='#' onclick=\"handlerProd('AA06'); return false;\" style='text-decoration:none;'><?=$tab2?>防晒</a></li>\n";
        str1=str1+"                                        <li style='width:100%'><a href='#' onclick=\"handlerProd('AA07'); return false;\" style='text-decoration:none;'><?=$tab2?>日霜/晚霜</a></li>\n";
        str1=str1+"                                        <li style='width:100%'><a href='#' onclick=\"handlerProd('AA08'); return false;\" style='text-decoration:none;'><?=$tab2?>眼部保護</a></li>\n";
        str1=str1+"                                        <li style='width:100%'><a href='#' onclick=\"handlerProd('AA09'); return false;\" style='text-decoration:none;'><?=$tab2?>局部保養</a></li>\n";
        str1=str1+"                                        <li style='width:100%'><a href='#' onclick=\"handlerProd('AA010'); return false;\" style='text-decoration:none;'><?=$tab2?>保養超值組</a></li>\n";
        str1=str1+"                                    </ul>\n";
        str1=str1+"                                </div>\n";
        str1=str1+"                            </li>\n";
        str1=str1+"                            <li style='width:100%'><a href='#' onclick=\"handlerProd('AB01'); return false;\" style='text-decoration:none;'><?=$tab1?>美髮/美體/沐浴</a></li>\n";
        str1=str1+"                            <li style='width:100%'><a href='#' onclick=\"handlerProd('AC01'); return false;\" style='text-decoration:none;'><?=$tab1?>彩妝/美容用品</a></li>\n";
        str1=str1+"                        </ul>\n";
        str1=str1+"                    </div>\n";
        str1=str1+"                </li>\n";
        str1=str1+"                <li style='width:100%'><a href='#' onclick=\"handlerProd('B001'); return false;\" style='text-decoration:none;' data-toggle='collapse' data-target='#toggleDemoB' data-parent='#sidenav1' class='collapsed'>保健</a></li>\n";
        str1=str1+"                <li style='width:100%'><a href='#' onclick=\"handlerProd('C001'); return false;\" style='text-decoration:none;' data-toggle='collapse' data-target='#toggleDemoC' data-parent='#sidenav1' class='collapsed'>食品</a></li>\n";
        str1=str1+"                <li style='width:100%'><a href='#' onclick=\"handlerProd('D001'); return false;\" style='text-decoration:none;' data-toggle='collapse' data-target='#toggleDemoD' data-parent='#sidenav1' class='collapsed'>旅遊</a></li>\n";
        str1=str1+"                <li style='width:100%'><a href='#' onclick=\"handlerProd('E001'); return false;\" style='text-decoration:none;' data-toggle='collapse' data-target='#toggleDemoE' data-parent='#sidenav1' class='collapsed'>婦幼</a></li>\n";
        str1=str1+"                <li style='width:100%'><a href='#' onclick=\"handlerProd('F001'); return false;\" style='text-decoration:none;' data-toggle='collapse' data-target='#toggleDemoF' data-parent='#sidenav1' class='collapsed'>3C</a></li>\n";
        str1=str1+"                <li style='width:100%'><a href='#' onclick=\"handlerProd('G001'); return false;\" style='text-decoration:none;' data-toggle='collapse' data-target='#toggleDemoG' data-parent='#sidenav1' class='collapsed'>家電</a></li>\n";
        str1=str1+"                <li style='width:100%'><a href='#' onclick=\"handlerProd('H001'); return false;\" style='text-decoration:none;' data-toggle='collapse' data-target='#toggleDemoH' data-parent='#sidenav1' class='collapsed'>服飾</a></li>\n";
        str1=str1+"                <li style='width:100%'><a href='#' onclick=\"handlerProd('I001'); return false;\" style='text-decoration:none;' data-toggle='collapse' data-target='#toggleDemoI' data-parent='#sidenav1' class='collapsed'>內衣</a></li>\n";
        str1=str1+"                <li style='width:100%'><a href='#' onclick=\"handlerProd('J001'); return false;\" style='text-decoration:none;' data-toggle='collapse' data-target='#toggleDemoJ' data-parent='#sidenav1' class='collapsed'>鞋包配飾</a></li>\n";
        str1=str1+"                <li style='width:100%'><a href='#' onclick=\"handlerProd('K001'); return false;\" style='text-decoration:none;' data-toggle='collapse' data-target='#toggleDemoK' data-parent='#sidenav1' class='collapsed'>精品/錶</a></li>\n";
        str1=str1+"                <li style='width:100%'><a href='#' onclick=\"handlerProd('L001'); return false;\" style='text-decoration:none;' data-toggle='collapse' data-target='#toggleDemoL' data-parent='#sidenav1' class='collapsed'>日用品</a></li>\n";
        str1=str1+"                <li style='width:100%'><a href='#' onclick=\"handlerProd('M001'); return false;\" style='text-decoration:none;' data-toggle='collapse' data-target='#toggleDemoM' data-parent='#sidenav1' class='collapsed'>居家生活</a></li>\n";
        str1=str1+"                <li style='width:100%'><a href='#' onclick=\"handlerProd('N001'); return false;\" style='text-decoration:none;' data-toggle='collapse' data-target='#toggleDemoN' data-parent='#sidenav1' class='collapsed'>傢具寢室</a></li>\n";
        str1=str1+"                <li style='width:100%'><a href='#' onclick=\"handlerProd('O001'); return false;\" style='text-decoration:none;' data-toggle='collapse' data-target='#toggleDemoO' data-parent='#sidenav1' class='collapsed'>運動休閑</a></li>\n";
        str1=str1+"                <li style='width:100%'><a href='#' onclick=\"handlerProd('P001'); return false;\" style='text-decoration:none;' data-toggle='collapse' data-target='#toggleDemoP' data-parent='#sidenav1' class='collapsed'>書店</a></li>\n";
        str1=str1+"                <li style='width:100%'><a href='#' onclick=\"handlerProd('Q001'); return false;\" style='text-decoration:none;' data-toggle='collapse' data-target='#toggleDemoQ' data-parent='#sidenav1' class='collapsed'>車類</a></li>\n";
        str1=str1+"                <li style='width:100%'><a href='#' onclick=\"handlerProd('R001'); return false;\" style='text-decoration:none;' data-toggle='collapse' data-target='#toggleDemoR' data-parent='#sidenav1' class='collapsed'>保險</a></li>\n";
        str1=str1+"            </ul>\n";
        str1=str1+"        </li>\n";
        str1=str1+"      </ul>\n";
        str1=str1+"    </div>\n";

        str1=str1+"	</div>\n";
        str1=str1+"</nav>\n";
    	document.getElementById("forMyNavbar").innerHTML = str1;
    };
  </script>
</head>
