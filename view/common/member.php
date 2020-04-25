<?php
// $mid = $_GET['mid'];
// if ($mid==null){
//     $mid=1;
// }
use report\user\Auth;

?>
<style type="text/css"> 
	@import url("https://www.w3schools.com/w3css/4/w3.css");
	@import url(WEB_ASSET_URL+"css/style3.css");
</style>
<div class="row affix-row">
	<div class="col-md-5-cols affix-sidebar">
		<div id="memberNav">
			<div class="sidebar-nav">
  				<div class="navbar navbar-default" role="navigation">
    				<div class="navbar-header">
      					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
					    	<span class="sr-only">Toggle navigation</span>
      						<span class="icon-bar"></span>
      						<span class="icon-bar"></span>
      						<span class="icon-bar"></span>
      					</button>
      					<span class="visible-xs navbar-brand">成泰生物科技有限公司</span>
    				</div>
    				<p id="tagForMember"></p>
					<script>
						var x =  $( window ).width();
						if (x>757){
							var str1= "   				<div class='w3-container'>\n";
							str1=str1+"    					<div class='w3-panel w3-pink text-center'>\n";
							str1=str1+"					      <font style='font-size:30pt;'>會員中心</font>\n";
							str1=str1+"    					</div>\n";
							str1=str1+"    				</div>\n";
							document.getElementById("tagForMember").innerHTML = str1;
							}
					</script>

    				<div class="navbar-collapse collapse sidebar-navbar-collapse">
      					<ul class="nav navbar-nav" id="sidenav01">
      					<?php
      					if (!Auth::isLogin()){
                        ?>
                        	<li style="width:100%"><a href="#" onclick="handler('1'); return false;" style="text-decoration:none;"><span class="glyphicon glyphicon-log-in"></span> 會員登入</a></li>
        					<li style="width:100%"><a href="#" onclick="handler('2'); return false;" style="text-decoration:none;"><span class="glyphicon glyphicon-registration-mark"></span> 會員註冊</a></li>
        					<li style="width:100%"><a href="#" onclick="handler('3'); return false;" style="text-decoration:none;"><span class="glyphicon glyphicon-cog"></span> 忘記密碼</a></li>
        					<li style="width:100%"><a href="#" onclick="handler0('1'); return false;" style="text-decoration:none;"><span class="glyphicon glyphicon-th-list"></span> 商品介紹</a></li>
        					<li style="width:100%"><a href="#" onclick="handler('sc'); return false;" style="text-decoration:none;"><span class="glyphicon glyphicon-shopping-cart"></span>購物車</a></li>
                        <?php 
      					}
      					else{
      					    if ($mid<4){
      					         $mid=5;
      					    }
      					    
      					?>
      						<li style="width:100%"><a href="#" onclick="handler('4'); return false;" style="text-decoration:none;"><span class="glyphicon glyphicon-log-out"></span> 登出</a></li>					
        					<li style="width:100%"><a href="#" onclick="handler0('1'); return false;" style="text-decoration:none;"><span class="glyphicon glyphicon-th-list"></span> 商品介紹</a></li>
        					<li style="width:100%"><a href="#" onclick="handler('sc'); return false;" style="text-decoration:none;"><span class="glyphicon glyphicon-shopping-cart"></span> 購物車</a></li>
        					<li style="width:100%">
          						<a href="#" data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">
          							<span class="glyphicon glyphicon-cloud"></span>  我的帳戶 <span class="caret"></span>
          						</a>
          						<div class="collapse" id="toggleDemo" style="height: 0px;">
            						<ul class="nav nav-list">
            						<!-- 
            							<li style="width:100%"><a href="#" onclick="handler('8'); return false;" style="text-decoration:none;">-組織圖</a></li>
            						 -->
            							<li style="width:100%"><a href="#" onclick="handler('9'); return false;" style="text-decoration:none;">-訂單查詢</a></li>
            							<li style="width:100%"><a href="#" onclick="handler('7'); return false;" style="text-decoration:none;">-購物金明細</a></li>
            						<!--
               							<li style="width:100%"><a href="#" onclick="handler('5'); return false;" style="text-decoration:none;">-SV值</a></li>
              							<li style="width:100%"><a href="#" onclick="handler('6'); return false;" style="text-decoration:none;">-直推組織圖</a></li>
              							<li style="width:100%"><a href="#" onclick="handler('7'); return false;" style="text-decoration:none;">-安置組織-立式</a></li>
              							<li style="width:100%"><a href="#" onclick="handler('8'); return false;" style="text-decoration:none;">-安置組織圖</a></li>
              							<li style="width:100%"><a href="#" onclick="handler('9'); return false;" style="text-decoration:none;">-歷史訂單查詢</a></li>
            						 -->
              							<li style="width:100%"><a href="#" onclick="handler('10'); return false;" style="text-decoration:none;"><span class="glyphicon glyphicon-qrcode"></span> QR CODE</a></li>
            						</ul>
          						</div>
        					</li>        					
        					<li style="width:100%"><a href="#" onclick="handler('11'); return false;" style="text-decoration:none;"><span class="glyphicon glyphicon glyphicon-user"></span> 會員權益</a></li>
        					<li style="width:100%"><a href="#" onclick="handler('12'); return false;" style="text-decoration:none;"><span class="glyphicon glyphicon glyphicon-user"></span> 購物金說明</a></li>
        					<li style="width:100%"><a href="#" onclick="handler('14'); return false;" style="text-decoration:none;"><span class="glyphicon glyphicon glyphicon-wrench"></span>個人資料調整</a></li>
        					<li style="width:100%"><a href="#" onclick="handler('13'); return false;" style="text-decoration:none;"><span class="glyphicon glyphicon glyphicon-pencil"></span> 更改密碼</a></li>
        				<?php
        				    if (Auth::isAdmin()>-1){
        				?>
        					<li style="width:100%">
          						<a href="#" data-toggle="collapse" data-target="#toggleDemo1" data-parent="#sidenav01" class="collapsed">
          							<span class="glyphicon glyphicon-cloud"></span>  管理功能 <span class="caret"></span>
          						</a>
          						<div class="collapse" id="toggleDemo1" style="height: 0px;">
            						<ul class="nav nav-list">
            							<li style="width:100%"><a href="#" onclick="handler('21'); return false;" style="text-decoration:none;">-設定BANNER圖片</a></li>
              							<li style="width:100%"><a href="#" onclick="handler('22'); return false;" style="text-decoration:none;">-設定產品分類圖片</a></li>
              							<li style="width:100%"><a href="#" onclick="handler('22a'); return false;" style="text-decoration:none;">-設定產品圖片</a></li>
              							<li style="width:100%"><a href="#" onclick="handler('23'); return false;" style="text-decoration:none;">紅陽交易資訊</a></li>
              							<!--
                                        <li style="width:100%"><a href="#" onclick="handler('21'); return false;" style="text-decoration:none;">-設定BANNER</a></li>
              							<li style="width:100%"><a href="#" onclick="handler('22z'); return false;" style="text-decoration:none;">-設定產品資料</a></li>
              							<li style="width:100%"><a href="#" onclick="handler('22'); return false;" style="text-decoration:none;">-設定產品分類</a></li>
              							<li style="width:100%"><a href="#" onclick="handler('22a'); return false;" style="text-decoration:none;">-設定限時特賣</a></li>
              							<li style="width:100%"><a href="#" onclick="handler('22b'); return false;" style="text-decoration:none;">-設定熱銷產品</a></li>
              							<li style="width:100%"><a href="#" onclick="handler('22c'); return false;" style="text-decoration:none;">-設定本月特惠</a></li>
              							<li style="width:100%"><a href="#" onclick="handler('23'); return false;" style="text-decoration:none;">-設定最新消息</a></li>
              							<li style="width:100%"><a href="#" onclick="handler('24'); return false;" style="text-decoration:none;">-設定見證分享</a></li>
              							 -->
              			<?php
              			       if (Auth::isAdmin()==9){
              			?>
              							<li style="width:100%"><a href="#" onclick="handler('25'); return false;" style="text-decoration:none;">設定管理人員</a></li>
              			<?php
              			       }
              			?>
            						</ul>
          						</div>
        					</li>                				
      					<?php
        				    }
      					}
      					?>
      					</ul>
      				</div><!--/.nav-collapse -->
    			</div>
  			</div>
			
		</div>
	</div>
	<div id="loginMobile">
	</div>
	<div class="col-md-20-cols">
<?php 
switch ($mid){
    case '1':
    default:
        include 'menu/mLogin.php';
        break;
    case '2':
        include 'menu/mRegister.php';
        break;
    case '3':
        include 'menu/mForgetPWD.php';
        break;
    case '4':
        include 'menu/mLogout.php';
        break;
    case '5':
        include 'menu/myAccount/mSV.php';
        break;
    case '10':
        include 'menu/myAccount/QRCode.php';
        break;
    case '11':
        include 'menu/mShowMemberRight.php';
        break;
    case '12':
        include 'menu/mShowMemberEP.php';
        break;
    case '13':
        include 'menu/mChangePWD.php';
        break;
    case '14':
        include 'menu/mEditPersonalData.php';
        break;
    case '6':
        include 'menu/myAccount/mOrg6.php';
        break;
    case '7':
        include 'menu/myAccount/mEXList.php';
        break;
    case '8':
        include 'menu/myAccount/mOrg8.php';
        break;
    case '9':
        include 'menu/myAccount/mHistory.php';
        break;
    case '21'://BANNER
        include 'menu/admin/mAdmin1.php';
        break;
    case '22z'://產品資料
        include 'menu/admin/mAdmin2z.php';
        break;
    case '22'://產品分類
        include 'menu/admin/mAdmin2.php';
        break;
    case '22a'://設定產品圖片
        include 'menu/admin/mAdmin2a.php';
        break;
    case '22b'://
        include 'menu/admin/mAdmin2b.php';
        break;
    case '22c'://
        include 'menu/admin/mAdmin2c.php';
        break;
    case '23'://紅陽交易
        include 'menu/admin/mAdmin3.php';
        break;
    case '24'://見證分享
        include 'menu/admin/mAdmin4.php';
        break;
    case '25'://設定管理人員, 最多兩位管理人員
        include 'menu/admin/mAdmin5.php';
        break;
    case 'smsVerify':
        include "menu/smsVerify.php";
        break;
}
if (Auth::isLogin()){
?>
<script>
if (isSmartPhone() ||  isTablet())
{
	var str="<div class=\"\">\n";
	str=str+" <ul class=\"nav navbar-nav\" id=\"sidenav02\" style=\"padding-left: 50px;\">\n";
	str=str+"  <li style=\"width:100%\"><a href=\"#\" onclick=\"handler('4'); return false;\" style=\"text-decoration:none;\"><span class=\"glyphicon glyphicon-log-out\"></span> 登出</a></li>\n";					
    str=str+"  <li style=\"width:100%\"><a href=\"#\" onclick=\"handler0('1'); return false;\" style=\"text-decoration:none;\"><span class=\"glyphicon glyphicon-th-list\"></span> 商品介紹</a></li>\n";
    str=str+"  <li style=\"width:100%\"><a href=\"#\" onclick=\"handler('sc'); return false;\" style=\"text-decoration:none;\"><span class=\"glyphicon glyphicon-shopping-cart\"></span> 購物車</a></li>\n";
    str=str+"  <li style=\"width:100%\"><a href=\"#\" onclick=\"handler('11'); return false;\" style=\"text-decoration:none;\"><span class=\"glyphicon glyphicon glyphicon-user\"></span> 會員權益</a></li>\n";
    str=str+"  <li style=\"width:100%\"><a href=\"#\" onclick=\"handler('12'); return false;\" style=\"text-decoration:none;\"><span class=\"glyphicon glyphicon glyphicon-user\"></span> 購物金說明</a></li>\n";
    str=str+"  <li style=\"width:100%\"><a href=\"#\" onclick=\"handler('14'); return false;\" style=\"text-decoration:none;\"><span class=\"glyphicon glyphicon glyphicon-wrench\"></span>個人資料調整</a></li>\n";
    str=str+"  <li style=\"width:100%\"><a href=\"#\" onclick=\"handler('13'); return false;\" style=\"text-decoration:none;\"><span class=\"glyphicon glyphicon glyphicon-pencil\"></span> 更改密碼</a></li>\n";
    str=str+"  <li style=\"width:100%\">\n";
    str=str+"   <a href=\"#\" data-toggle=\"collapse\" data-target=\"#toggleDemo\" data-parent=\"#sidenav01\" class=\"collapsed\">\n";
    str=str+"    <span class=\"glyphicon glyphicon-cloud\"></span>  我的帳戶 <span class=\"caret\"></span>\n";
    str=str+"   </a>\n";
   	str-str+"   <div class=\"collapse\" id=\"toggleDemo\" style=\"height: 0px;\">\n";
	str=str+"    <ul class=\"nav nav-list\">\n";
    str=str+"     <li style=\"width:100%\"><a href=\"#\" onclick=\"handler('9'); return false;\" style=\"text-decoration:none;\">-訂單查詢</a></li>\n";
    str=str+"     <li style=\"width:100%\"><a href=\"#\" onclick=\"handler('7'); return false;\" style=\"text-decoration:none;\">-購物金明細</a></li>\n";
    str=str+"     <li style=\"width:100%\"><a href=\"#\" onclick=\"handler('10'); return false;\" style=\"text-decoration:none;\"><span class=\"glyphicon glyphicon-qrcode\"></span> QR CODE</a></li>\n";
    str=str+"    </ul>\n";
    str=str+"   </div>\n";
    str=str+"  </li>\n";        					
   
	str=str+" </ul>\n";
	str=str+"</div>\n";
	//$('#loginMobile').html(str);
	document.getElementById("loginMobile").innerHTML = str;
}
</script>	
<?php 
}
?>
	</div>
</div>
