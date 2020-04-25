<?php 
use report\user\Auth;
?>
<!-- <!-- Pushy Menu --> -->
<!-- <nav class="pushy pushy-left"> -->
<!--     <div class="pushy-content"> -->
<!--         <ul class="list-unstyled"> 
            <li class="pushy-link"><a href="#" onclick="handler('1'); return false;" style="text-decoration:none;"><font face="標楷體">登出</font></a></li>
            <li class="pushy-link"><a href="#" onclick="handler('2'); return false;" style="text-decoration:none;"><font face="標楷體">變更密碼</font></a></li>
            <li class="pushy-link"><a href="#" onclick="handler('5d'); return false;" style="text-decoration:none;"><font face="標楷體">直推組織圖</font></a></li>
            <li class="pushy-link"><a href="#" onclick="handler('5e'); return false;" style="text-decoration:none;"><font face="標楷體">安置組織-立式</font></a></li>
            <li class="pushy-link"><a href="#" onclick="handler('5f'); return false;" style="text-decoration:none;"><font face="標楷體">安置組織圖</font></a></li>
	        <li class="pushy-link"><a href="#" onclick="handler('8a'); return false;" style="text-decoration:none;"><font face="標楷體">獎金明細</font></a></li>
	        <li class="pushy-link"><a href="#" onclick="handler('9a'); return false;" style="text-decoration:none;"><font face="標楷體">線上購物</font></a></li>
         </ul> -->
<!--     </div> -->
<!-- </nav> -->


<div id="header" class="align-bottom">
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
	  		<div id="myNavbar0">
	  			<div class="collapse navbar-collapse nav0">
 	    	    	<ul class="nav navbar-nav navbar-right">
<?php 
if (!Auth::isLogin()){
?>
    		        	<li><a href="#" onclick="handler('2'); return false;" style="text-decoration:none;"><img src="assets/images/logoMB.jpg" class="img-rounded" width="auto" height="auto"></a></li>
<?php 
}
?>
						<li><a href="a href="#" onclick="handler('8'); return false;" style="text-decoration:none;"><img src="assets/images/logoSC.jpg" class="img-rounded" width="auto" height="auto"></a></li>        		    	
        	  		</ul>
        		</div>
	  		</div>
	    	<div class="navbar-header">
          		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>                        
      	  		</button>
	      		<a href="#" onclick="handler('1'); return false;" style="text-decoration:none;"><img src="assets/images/logo1.jpg" class="img-rounded" width="auto" height="80"></a>
	    	</div>
        	<div class="collapse navbar-collapse" id="myNavbar">
 	        	<ul class="nav navbar-nav navbar-right nav2">
<?php
if (Auth::isLogin()){
?>
            		<li class="dropdown">
            			<a class="dropdown-toggle" data-toggle="dropdown" href="#">會員<br>Member<span class="caret"></span></a>
	              		<ul class="dropdown-menu">
	              			<li><a href="#" onclick="handler('0'); return false;" style="text-decoration:none;">登出</a></li>
							<li><a href="#" onclick="handler('3'); return false;" style="text-decoration:none;">變更密碼</a></li>
							<li><a href="#" onclick="handler('4'); return false;" style="text-decoration:none;">直推圖組織</a></li>
							<li><a href="#" onclick="handler('5'); return false;" style="text-decoration:none;">安置組織-立式</a></li>
							<li><a href="#" onclick="handler('6'); return false;" style="text-decoration:none;">安置組織圖</a></li>
							<li><a href="#" onclick="handler('7'); return false;" style="text-decoration:none;">獎金明細</a></li>
							<li><a href="#" onclick="handler('8'); return false;" style="text-decoration:none;">線上購物</a></li>
	              		</ul>
            		</li>
<?php 
}
?>
        	    	<li><a href="index.php?#abus">關於我們<br>About US</a></li>
            		<li class="dropdown">
                  		<a class="dropdown-toggle" data-toggle="dropdown" href="#">語言<br>Language<span class="caret"></span></a>
	              		<ul class="dropdown-menu">
    	           	 		<li><a href="#">簡體</a></li>
        	        		<li><a href="#">繁體</a></li>
            	  		</ul>
            		</li>
          		</ul>
        	</div>
  	  	</div>
  	  	<div>
  			<hr id="hr">
  	  	</div>
	</nav>
</div>