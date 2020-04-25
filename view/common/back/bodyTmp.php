<!-- Site Overlay -->
<div class="site-overlay"></div>

<!-- Your Content -->
<div class="container" align="center">
    <!-- Menu Button -->
    <div class="row">    
    	<div class="col-xs-18 col-sm-12 text-center mh1" style="background-image: url(/assets/images/logo.jpg);background-repeat: no-repeat;background-size: 100% 100%;">
    		<div class="menu-btn"><span class="hamburger">&#9776;</span>&nbsp;&nbsp;&nbsp;&nbsp;XXX</div>
    	</div>
    </div>
    <?php 
    use report\user\Session;

$menuId=isset($g['menuIds'])?$g['menuIds']:$menuId;
    if ($menuId!='1' && substr($menuId,0,1)!='9'){
        $menuId='9a';
    }
    if ($menuId='9a'){
        $name = Session::get('tmpMBNAME');
        $str = "<br><br><h3 align=\"center\"><font face=\"標楷體\">歡迎 ".$name." 蒞臨臨時購物專區</font></h3><br>";
        echo $str;
    }
    $actionFile='menu/menu'.$menuId.'.php';
    include $actionFile;
    ?>
</div>
<script src="/assets/js/pushy.min.js?v=1.1.0"></script>
