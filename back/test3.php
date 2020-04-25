<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="/assets/css/normalize.css">
        <link rel="stylesheet" href="/assets/css/site.css?v=1.1.0">
        <!-- Pushy CSS -->
        <link rel="stylesheet" href="/assets/css/pushy.css?v=1.1.0">
       	<link rel="stylesheet" href="http://kagana.com.tw/assets/css/bootstrap.min.css">
       	 <link rel="stylesheet" href="http://kagana.com.tw/assets/dist/themes/default/style.min.css" />
        <script src="http://kagana.com.tw/assets/js/tool.js"></script>
        <!-- jQuery -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="http://kagana.com.tw/assets/js/jquery-2.1.4.js?v=20180124"></script>
        
	     <script src="http://kagana.com.tw/assets/js/jquery-ui.js?v=20180124"></script>
	     <script src="http://kagana.com.tw/assets/js/bootstrap.min.js"></script>
        	<style>
        table{
            border-collapse: separate !important;
        }
    </style>

	 
	 <script>
      var defUrl = "http://kagana.com.tw/";
    </script>
    <script>
    	$( document ).ready(function() {
    	  wsWidth=$(window).width();
    	  if (wsWidth>1200){
        	  $(".main-container").css("width","1170px")
    	  }
    	  else if(wsWidth>992){
        	  $(".main-container").css("width","970px")
    	  }
    	  else if (wsWidth>768){
        	  $(".main-container").css("width","750px")
    	  }
    	});
    	function handler(apID){
    		document.getElementById('menuId').value=apID ;
    		document.getElementById('menuForm').submit();
    		 
    	};
    </script>
        
    </head>
	<body>
<!-- Pushy Menu -->
<nav class="pushy pushy-left">
    <div class="pushy-content">
        <ul>
            <li class="pushy-link"><a href="#" onclick="handler('1'); return false;"><font face="標楷體">登出</font></a></li>
            <li class="pushy-link"><a href="#" onclick="handler('2'); return false;"><font face="標楷體">變更密碼</font></a></li>
            <li class="pushy-link"><a href="#" onclick="handler('5d'); return false;"><font face="標楷體">直推組織圖</font></a></li>
            <li class="pushy-link"><a href="#" onclick="handler('5e'); return false;"><font face="標楷體">安置組織-立式</font></a></li>
            <li class="pushy-link"><a href="#" onclick="handler('5f'); return false;"><font face="標楷體">安置組織圖</font></a></li>
	        <li class="pushy-link"><a href="#" onclick="handler('8a'); return false;"><font face="標楷體">獎金明細</font></a></li>
	        <li class="pushy-link"><a href="#" onclick="handler('9a'); return false;"><font face="標楷體">產品清單</font></a></li>
        </ul>
    </div>
</nav>
<!-- Site Overlay -->
<div class="site-overlay"></div>

<!-- Your Content -->
<div class="main-container">
	<div class="container">
    <!-- Menu Button -->
    <div class="row">    
    	<div class="col-xs-18 col-sm-12 text-center mh1" style="background-image: url(/assets/images/logo.jpg);background-repeat: no-repeat;background-size: 100% 100%;">
    		<div class="menu-btn"><span class="hamburger">&#9776;</span>&nbsp;&nbsp;&nbsp;&nbsp;XXX</div>
    	</div>
    </div>    
</div>
	
</div>
<script src="/assets/js/pushy.min.js?v=1.1.0"></script>
<form id="menuForm" action='index.php' enctype="multipart/form-data" method="post">
<input type="hidden" id='menuId' name="menuId" value="">
</form></body>

</html>
