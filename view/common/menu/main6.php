<?php
// $mid = $_GET['mid'];
// if ($mid==null){
//     $mid=1;
// }
use report\user\Auth;
$tab1="&nbsp;&nbsp;";
$tab2="&nbsp;&nbsp;&nbsp;&nbsp;";
$prodID = isset($g['prodID'])?$g['prodID']:'0';
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
      					<span class="visible-xs navbar-brand">Sidebar menu</span>
    				</div>
    				<div class="w3-container">
    					<div class="w3-panel w3-pink text-center">
					      <font style="font-size:30pt;">促銷活動</font>
    					</div>
    				</div>
    				<div class="navbar-collapse collapse sidebar-navbar-collapse">
      					<ul class="nav navbar-nav" id="sidenav01">
      						<li style="width:100%">
      							<a href="#" onclick="handlerActive('6'); return false;" style="text-decoration:none;" data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">
      								本月特惠<span class="caret"></span>
      							</a>
      						</li>
        					<li style="width:100%">
          						<a href="#" onclick="handlerActive('7'); return false;" style="text-decoration:none;" data-toggle="collapse" data-target="#toggleDemo2" data-parent="#sidenav0" class="collapsed">
          							熱銷商品 </span>
          						</a>
        					</li>        					
        					<li style="width:100%">
          						<a href="#" onclick="handlerActive('8'); return false;" style="text-decoration:none;" data-toggle="collapse" data-target="#toggleDemo3" data-parent="#sidenav0" class="collapsed">
          							限時特賣 </span>
          						</a>
        					</li>
      					</ul>
      				</div><!--/.nav-collapse -->
    			</div>
  			</div>
			
		</div>
	</div>
	<div class="col-md-20-cols">
<?php 
switch ($mainID){ 
    case '6'://限時特賣
        include 'active1.php';
        break;
    case '7'://熱銷商品
        include 'active2.php';
        break;
    case 8:
    default://本月特惠
        include 'active3.php';
        break;
}
?>
	</div>
</div>