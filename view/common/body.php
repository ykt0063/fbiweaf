<?php
use report\user\Auth;
use report\user\Session;
$tagRun='';
if (isset($g['payStep'])){
    $tagRun='disabled="disabled"';
    $tagRun='';
    ?>
<style type="text/css">
    a[disabled="disabled"] {
        pointer-events: none;
    }
</style>
<?php 
}
?>
  <div id="headerID" class="header" style="background-color:#F0EDE4;">
  <div class="row" id="navHeader">
  	<div class="col-md-4 col-md-offset-1">
  		<a href="#" onclick="handler0('1'); return false;" style="text-decoration:none;" <?=$tagRun?>>
	  		<img src="<?=WEB_ASSET_URL?>images/main/LOGO.png" height="42" width="148" style="margin-top: 20px;">
	  	</a>
  		<!--
  		    <a class="navbar-logo" href="#" onclick="handler('0'); return false;" style="text-decoration:none;"></a>  
  		 -->
  	</div>
  	<div class="col-md-6">
  		<div class="row">
			<nav class="navbar-inverse nav-upper">
				<div class="container-fluid">
    				<ul class="nav navbar-nav">
<?php 
if (!Auth::isLogin()){
?>
    				  <li><a href="#" onclick="handler('1'); return false;" style="text-decoration:none;"><font style="font-size:14px">會員登入</font></a></li>
<?php 
}
elseif(Session::get('tmpMBNO')!=FALSE){
?>
					  <li><font style="color:black;">歡迎&nbsp;<?php echo Session::get('tmpMBNO'); ?>&nbsp;登入</font></li>
      				  <li><a href="#" onclick="handler('4'); return false;" > 登出</a></li>					
<?php 
}
else{
?>
					  <li><font style="color:black;">歡迎&nbsp;<?php echo Session::get('name'); ?>&nbsp;登入</font></li>
	     		  	  <li><a href="#" onclick="handler('4'); return false;"> 登出</a></li>					
					  
<?php 
}
?>
				      <li><a href="#" onclick="handler('1'); return false;" style="text-decoration:none;" <?=$tagRun?>><font style="font-size:14px">會員中心</font></a></li>
    				  <li><a href="#" <?=$scLinkTag?> style="text-decoration:none;" <?=$tagRun?>><font id='scIDTAG' style="font-size:15px">購物車<span class="scNumber"></span></font></a></li>
      				  <li><a href="#" onclick="handler0('1'); return false;" style="text-decoration:none;" <?=$tagRun?>><font style="font-size:14px">商品介紹</font></a></li>
    				  
    				  <!--
    				  <li><a href="#"><font style="font-size:14px">繁體</font></a></li>
    				  <li><a href="#"><font style="font-size:14px">簡體</font></a></li> 
    				   -->
    				</ul>
  				</div>
  			</nav>
  		</div>
  		<div class="row">
			<nav class="navbar-inverse nav-upper">
				<div class="container-fluid">
    				<ul class="nav navbar-nav">
    				  <li>
    				  <!-- 
    				  	<form class="navbar-form" role="search">
        					<div class="form-group">
          						<div class="input-group">
            						<input type="text" class="form-control" style="width: 200px;" placeholder="商品搜尋" <?=$tagRun?>>
            						<span class="input-group-btn">
              							<button type="submit" class="btn btn-default" <?=$tagRun?>><span class="glyphicon glyphicon-search"></span></button>
            						</span>
          						</div>
        					</div>
     		 			</form>
     		 			 -->
    				  </li>
				      <li class="top"><a href="https://www.facebook.com/2299936496940279" <?=$tagRun?>><img src="<?=WEB_ASSET_URL?>images/main/facebook.png"></a></li>
				      <li class="top"><a href="https://line.me/R/ti/p/%40216hkkfv" <?=$tagRun?>><img src="<?=WEB_ASSET_URL?>images/main/line.png"></a></li>
    				</ul>
  				</div>
  			</nav>
  		</div>
  	</div>
  </div>
<!--   <div id="divHr"><hr id="hr"></div> -->
<p id="forMyNavbar"></p>
<!-- <nav id="nav-button" class="navbar navbar-inverse navbar-static-top navbar-lower "> -->
<!--   <div class="container-fluid"> -->
    
<!--     <div class="navbar-header"> -->
      
<!--       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> -->
<!--         <span class="icon-bar"></span> -->
<!--         <span class="icon-bar"></span> -->
<!--         <span class="icon-bar"></span> -->
<!--       </button> -->
<!--     </div> -->
    
   
<!--   </div> -->
<!-- </nav> -->
  </div>
  <p id="forBrTag"></p>
  <div id = "WRAPPER" class="content container" >
<?php
//echo "<!-- mid=".$mid." -->";
switch($mid){
    case '0':
        include "main.php";
        break;
    case 'sc':
        include "menu/sc.php";
        break;
    case 'pay':
        include "menu/pay.php";
        break;
    case 'Privacy':
        include "menu/Privacy.php";
        break;
    default:
        include "member.php";    
        break;        

}
// if ($mid==0){
//     include "main.php";
// }elseif($mid=='sc'){
//     include "menu/sc.php";    
// }
// else{
//     include "member.php";
// }
?>
<!--   </div> -->
