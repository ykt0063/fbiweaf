<?php
// $mid = $_GET['mid'];
// if ($mid==null){
//     $mid=1;
// }
use report\user\Auth;
use report\user\Session;
use report\user\product;
$tab1="&nbsp;&nbsp;";
$tab2="&nbsp;&nbsp;&nbsp;&nbsp;";
$prodID = isset($g['prodID'])?$g['prodID']:'0';
$obj = product::getProductType();
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
			    str1=str1+"					    	<font style=\"font-size:40pt;\">商品介紹</font>\n";
			    str1=str1+"    					</div>\n";
		    	str1=str1+"    				</div>\n";				
			}
	        str1=str1+"    				<div class=\"navbar-collapse collapse sidebar-navbar-collapse\">\n";
	        if (x<757){
		    	str1=str1+"      				<ul class=\"nav navbar-nav\" id=\"sidenav0A\">\n";
<?php		    

if (!Auth::isLogin()){
?>
					str1=str1+"        					<li><a href=\"#\" onclick=\"handler0('1'); return false;\" style=\"text-decoration:none;\"><font style=\"font-size:14px\"><span class='glyphicon glyphicon-log-in'></span>回首頁</font></a></li>\n";
   	        		str1=str1+"        					<li><a href=\"#\" onclick=\"handler('1'); return false;\" style=\"text-decoration:none;\"><font style=\"font-size:14px\"><span class='glyphicon glyphicon-log-in'></span>會員登入</font></a></li>\n";
   	        		str1=str1+"        					<li><a href='#' onclick=\"handler('2'); return false;\" style='text-decoration:none;'><span class='glyphicon glyphicon-registration-mark'></span> 會員註冊</a></li>\n";
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
<?php 
$data=$obj['data'];
$data1=array();
$data2=array();
$ct=count($data);
for($i=0;$i<$ct;$i++){
    $tmp=$data[$i];
    $typeNO=$tmp['typeNO'];
    $typeName=$tmp['typeName'];
    $data1[]=$typeNO;
    $data2[]=$typeName;
//    echo "str1=str1+'        					<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('".$typeNO."'); return false;\" style=\"text-decoration:none;\" data-toggle=\"collapse\" data-target=\"#toggleDemo2\" data-parent=\"#sidenav0\" class=\"collapsed\">".$typeName."</a></li>\n\";";
?>
			str1=str1+"        					<li style=\"width:100%\"><a href=\"#\" onclick=\"handlerProd('<?=$typeNO?>'); return false;\" style=\"text-decoration:none;\" data-toggle=\"collapse\" data-target=\"#toggleDemo2\" data-parent=\"#sidenav0\" class=\"collapsed\"><?=$typeName?></a></li>\n";
<?php 
}
?>
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
if (in_array($prodID,$data1)){
    include 'prodAA.php';//分類產品
}
else{
    switch ($prodID){ 
        case 'a':
            include 'product.php';//個別產品
            break;
        case 0:
        default:
            include 'prod0.php';//全部產品
            break;
    }
}
?>
	</div>
</div>