<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

        <link rel="stylesheet" href="/assets/css/normalize.css">
        <link rel="stylesheet" href="/assets/css/site.css?v=1.1.0">
        <!-- Pushy CSS -->
        <link rel="stylesheet" href="/assets/css/pushy.css?v=1.1.0">
        
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    </head>
    <body>
        <!-- Pushy Menu -->
        <nav class="pushy pushy-left" data-focus="#first-link">
            <div class="pushy-content">
                <ul>
            <li class="pushy-link"><a href="#" onclick="handler('1'); return false;"><font face="標楷體">登出</font></a></li>
            <li class="pushy-link"><a href="#" onclick="handler('2'); return false;"><font face="標楷體">變更密碼</font></a></li>
            <li class="pushy-link"><a href="#" onclick="handler('5d'); return false;"><font face="標楷體">直推組織圖</font></a></li>
            <li class="pushy-link"><a href="#" onclick="handler('5e'); return false;"><font face="標楷體">安置組織-立式</font></a></li>
            <li class="pushy-link"><a href="#" onclick="handler('5f'); return false;"><font face="標楷體">安置組織圖</font></a></li>
	        <li class="pushy-link"><a href="#" onclick="handler('8a'); return false;"><font face="標楷體">獎金明細</font></a></li>
                    
                </ul>
            </div>
        </nav>

        <!-- Site Overlay -->
        <div class="site-overlay"></div>

        <!-- Your Content -->
        <div id="container">
            <!-- Menu Button -->
            <button class="menu-btn">&#9776; Menu</button>
			<?php require_once( __DIR__."/common/body.php"); ?>
        </div>
        
        <!-- Pushy JS -->
        <script src="/assets/js/pushy.min.js?v=1.1.0"></script>

        <!-- Demo Google Analytics (Don't use this!) -->
        <script>
            var _gaq=[['_setAccount','UA-3555686-2'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>

    </body>
</html>
