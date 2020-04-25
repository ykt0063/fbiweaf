<?php
// $mid = $_GET['mid'];
// if ($mid==null){
//     $mid=1;
// }
use report\user\Auth;
use report\user\Session;
$tab1="&nbsp;&nbsp;";
$tab2="&nbsp;&nbsp;&nbsp;&nbsp;";
$prodID = isset($g['prodID'])?$g['prodID']:'0';
?>
<style type="text/css"> 
	@import url("https://www.w3schools.com/w3css/4/w3.css");
	@import url(WEB_ASSET_URL+"css/style3.css");
</style>
<div class="row affix-row">
	<p id="forSubmemberNav"></p>
	<script>
		setProdMenu();
		function setProdMenu(){
			var x = $( window ).width();
	        var str1="<div class=\"col-md-5-cols affix-sidebar\">\n";
	        str1=str1+"		<div id=\"memberNav\">\n";
	        str1=str1+"			<div class=\"sidebar-nav\">\n";
	        str1=str1+"  			<div class=\"navbar navbar-default\" role=\"navigation\">\n";
	        str1=str1+"    				<div class=\"navbar-header\">\n";
	        str1=str1+"      				<button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".sidebar-navbar-collapse\">\n";
	        str1=str1+"					    	<span class=\"sr-only\">Toggle navigation</span>\n";
	        str1=str1+"      					<span class=\"icon-bar\"></span>\n";
	        str1=str1+"      					<span class=\"icon-bar\"></span>\n";
	        str1=str1+"      					<span class=\"icon-bar\"></span>\n";
	        str1=str1+"      				</button>\n";
	        str1=str1+"      				<span class=\"visible-xs navbar-brand\">成泰生物科技有限公司</span>\n";
	        str1=str1+"    				</div>\n";
	        if (x>757){
			    str1=str1+"    				<div class=\"w3-container\">\n";
			    str1=str1+"    					<div class=\"w3-panel w3-pink text-center\">\n";
			    str1=str1+"					    	<font style=\"font-size:30pt;\">商品介紹</font>\n";
			    str1=str1+"    					</div>\n";
		    	str1=str1+"    				</div>\n";				
			}
	        str1=str1+"    				<div class=\"navbar-collapse collapse sidebar-navbar-collapse\">\n";
	        if (x<757){
		    	str1=str1+"      				<ul class=\"nav navbar-nav\" id=\"sidenav0A\">\n";
<?php		    

if (!Auth::isLogin()){
?>
   	        		str1=str1+"        					<li><a href=\"#\" onclick=\"handler('1'); return false;\" style=\"text-decoration:none;\"><font style=\"font-size:14px\"><span class='glyphicon glyphicon-log-in'></span>會員登入</font></a></li>\n";
<?php 
	    	    }
        	    else{
?>
   					str1=str1+"         				<li><font style=\"color:black;\">歡迎&nbsp;<?php echo Session::get('name'); ?>&nbsp;登入</font></li>\n";
   					str1=str1+"							<li><a href='#' onclick=\"handler('1'); return false;\" style='text-decoration:none;'><font style='font-size:14px'><span class='glyphicon glyphicon-user'></span>會員中心</font></a></li>\n";
<?php 
		        }	            
?>
                str1=str1+"							<li><a href='#' onclick=\"handler('sc'); return false;\" style='text-decoration:none;'><font style='font-size:14px'><span class='glyphicon glyphicon-shopping-cart'></span>購物車</font></a></li>\n";
				str1=str1+"      					<li style=\"width:100%\">\n";
				str1=str1+"      						<a href=\"#\" data-toggle=\"collapse\" data-target=\"#toggleDemo0A\" data-parent=\"#sidenav0A\" class=\"collapsed\"><span class='glyphicon glyphicon-th-list'></span>商品介紹<span class=\"caret\"></span></a>\n";
	        	str1=str1+"          					<div class=\"collapse\" id=\"toggleDemo0A\" style=\"height: 0px;\">\n";
	        }
		    str1=str1+"      				<ul class=\"nav navbar-nav\" id=\"sidenav01\">\n";
	        str1=str1+"      					<li style=\"width:100%\">\n";
	        str1=str1+"      						<a href=\"#\" data-toggle=\"collapse\" data-target=\"#toggleDemo\" data-parent=\"#sidenav01\" class=\"collapsed\">美妝<span class=\"caret\"></span></a>\n";
	        str1=str1+"          					<div class=\"collapse\" id=\"toggleDemo\" style=\"height: 0px;\">\n";
	        str1=str1+"            						<ul class=\"nav nav-list\" id=\"sidenav01a\">\n";
	        str1=str1+"              						<li style=\"width:100%\">\n";
	        str1=str1+"              							<a href=\"#\" data-toggle=\"collapse\" data-target=\"#toggleDemo1\" data-parent=\"#sidenav01a\" class=\"collapsed\"><?=$tab1?>臉部保護<span class=\"caret\"></span></a>\n";
	        str1=str1+"			          						<div class=\"collapse\" id=\"toggleDemo1\" style=\"height: 0px;\">\n";
	        str1=str1+"            									<ul class=\"nav nav-list\">\n";
	        str1=str1+"            										<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('AA01'); return false;\" style=\"text-decoration:none;\"><?=$tab2?>面膜</a></li>\n";
	        str1=str1+"            										<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('AA02'); return false;\" style=\"text-decoration:none;\"><?=$tab2?>卸妝</a></li>\n";
	        str1=str1+"            										<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('AA03'); return false;\" style=\"text-decoration:none;\"><?=$tab2?>化妝水</a></li>\n";
	        str1=str1+"            										<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('AA04'); return false;\" style=\"text-decoration:none;\"><?=$tab2?>精華液/安瓶</a></li>\n";
	        str1=str1+"            										<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('AA05'); return false;\" style=\"text-decoration:none;\"><?=$tab2?>凝膠/凝凍</a></li>\n";
	        str1=str1+"            										<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('AA06'); return false;\" style=\"text-decoration:none;\"><?=$tab2?>防晒</a></li>\n";
	        str1=str1+"            										<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('AA07'); return false;\" style=\"text-decoration:none;\"><?=$tab2?>日霜/晚霜</a></li>\n";
	        str1=str1+"            										<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('AA08'); return false;\" style=\"text-decoration:none;\"><?=$tab2?>眼部保護</a></li>\n";
	        str1=str1+"            										<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('AA09'); return false;\" style=\"text-decoration:none;\"><?=$tab2?>局部保養</a></li>\n";
	        str1=str1+"            										<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('AA10'); return false;\" style=\"text-decoration:none;\"><?=$tab2?>保養超值組</a></li>\n";
	        str1=str1+"            									</ul>\n";
	        str1=str1+"            								</div>\n";
	        str1=str1+"              						</li>\n";
	        str1=str1+"              						<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('AB01'); return false;\" style=\"text-decoration:none;\"><?=$tab1?>美髮/美體/沐浴</a></li>\n";
	        str1=str1+"              						<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('AC01'); return false;\" style=\"text-decoration:none;\"><?=$tab1?>彩妝/美容用品</a></li>\n";
	        str1=str1+"            						</ul>\n";
	        str1=str1+"          					</div>\n";
	        str1=str1+"      					</li>\n";
	        str1=str1+"        					<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('B001'); return false;\" style=\"text-decoration:none;\" data-toggle=\"collapse\" data-target=\"#toggleDemo2\" data-parent=\"#sidenav0\" class=\"collapsed\">保健</a></li>\n";
	        str1=str1+"        					<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('C001'); return false;\" style=\"text-decoration:none;\" data-toggle=\"collapse\" data-target=\"#toggleDemo3\" data-parent=\"#sidenav0\" class=\"collapsed\">食品</a></li>\n";
	        str1=str1+"        					<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('D001'); return false;\" style=\"text-decoration:none;\" data-toggle=\"collapse\" data-target=\"#toggleDemo4\" data-parent=\"#sidenav0\" class=\"collapsed\">旅遊</a></li>\n";
	        str1=str1+"							<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('E001'); return false;\" style=\"text-decoration:none;\" data-toggle=\"collapse\" data-target=\"#toggleDemo5\" data-parent=\"#sidenav0\" class=\"collapsed\">婦幼</a></li>\n";
	        str1=str1+"							<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('F001'); return false;\" style=\"text-decoration:none;\" data-toggle=\"collapse\" data-target=\"#toggleDemo6\" data-parent=\"#sidenav0\" class=\"collapsed\">3C</a></li>\n";
	        str1=str1+"							<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('G001'); return false;\" style=\"text-decoration:none;\" data-toggle=\"collapse\" data-target=\"#toggleDemo7\" data-parent=\"#sidenav0\" class=\"collapsed\">家電</a></li>\n";
	        str1=str1+"							<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('H001'); return false;\" style=\"text-decoration:none;\" data-toggle=\"collapse\" data-target=\"#toggleDemo8\" data-parent=\"#sidenav0\" class=\"collapsed\">服飾</a></li>\n";
	        str1=str1+"							<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('I001'); return false;\" style=\"text-decoration:none;\" data-toggle=\"collapse\" data-target=\"#toggleDemo9\" data-parent=\"#sidenav0\" class=\"collapsed\">內衣</a></li>\n";
	        str1=str1+"							<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('J001'); return false;\" style=\"text-decoration:none;\" data-toggle=\"collapse\" data-target=\"#toggleDemo10\" data-parent=\"#sidenav0\" class=\"collapsed\">鞋包配飾</a></li>\n";
	        str1=str1+"							<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('K001'); return false;\" style=\"text-decoration:none;\" data-toggle=\"collapse\" data-target=\"#toggleDemo11\" data-parent=\"#sidenav0\" class=\"collapsed\">精品/錶</a></li>\n";
	        str1=str1+"							<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('L001'); return false;\" style=\"text-decoration:none;\" data-toggle=\"collapse\" data-target=\"#toggleDemo12\" data-parent=\"#sidenav0\" class=\"collapsed\">日用品</a></li>\n";
	        str1=str1+"							<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('M001'); return false;\" style=\"text-decoration:none;\" data-toggle=\"collapse\" data-target=\"#toggleDemo13\" data-parent=\"#sidenav0\" class=\"collapsed\">居家生活</a></li>\n";
	        str1=str1+"							<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('N001'); return false;\" style=\"text-decoration:none;\" data-toggle=\"collapse\" data-target=\"#toggleDemo14\" data-parent=\"#sidenav0\" class=\"collapsed\">傢俱寢室</a></li>\n";
	        str1=str1+"							<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('O001'); return false;\" style=\"text-decoration:none;\" data-toggle=\"collapse\" data-target=\"#toggleDemo15\" data-parent=\"#sidenav0\" class=\"collapsed\">運動休閒</a></li>\n";
	        str1=str1+"							<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('P001'); return false;\" style=\"text-decoration:none;\" data-toggle=\"collapse\" data-target=\"#toggleDemo16\" data-parent=\"#sidenav0\" class=\"collapsed\">書店</a></li>\n";
	        str1=str1+"							<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('Q001'); return false;\" style=\"text-decoration:none;\" data-toggle=\"collapse\" data-target=\"#toggleDemo17\" data-parent=\"#sidenav0\" class=\"collapsed\">車類</a></li>\n";
	        str1=str1+"							<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('R001'); return false;\" style=\"text-decoration:none;\" data-toggle=\"collapse\" data-target=\"#toggleDemo18\" data-parent=\"#sidenav0\" class=\"collapsed\">保險</a></li>\n";
	        str1=str1+"      				</ul>\n";
			if (x<757){
				str1=str1+"                				</div>\n";
				str1=str1+"                			</li>\n";
				str1=str1+"                		</ul>\n";
			}
	        str1=str1+"      			</div>\n";        
	        str1=str1+"    			</div>\n";
	        str1=str1+"  		</div>\n";
	        str1=str1+"		</div>\n";
	        str1=str1+"	</div>\n";
	        document.getElementById("forSubmemberNav").innerHTML = str1;
	        if (x<757){
	        	$("#sidenav01").css("margin-right","5px");
		        $("#sidenav01").css("margin-left","5px");
	        }
	    }
	</script>
	<div class="col-md-20-cols">
<?php 
switch ($prodID){ 
    case 'AA01':
    case 'AA02':
    case 'AA03':
    case 'AA04':
    case 'AA05':
    case 'AA06':
    case 'AA07':
    case 'AA08':
    case 'AA09':
    case 'AA10':
    case 'AB01':
    case 'AC01':
    case 'B001':
    case 'C001':
    case 'D001':
    case 'E001':
    case 'F001':
    case 'G001':
    case 'H001':
    case 'I001':
    case 'J001':
    case 'K001':
    case 'L001':
    case 'M001':
    case 'N001':
    case 'O001':
    case 'P001':
    case 'Q001':
    case 'R001':
        include 'prodAA.php';
        break;
    case 'a':
        include 'product.php';
        break;
    case 0:
    default:
        include 'prod0.php';
        break;
}
?>
	</div>
</div>