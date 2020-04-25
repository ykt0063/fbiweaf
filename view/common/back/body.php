<?php 
if ($menuID==4||$menuID==6){
echo "\n";
?>
<!-- Site Overlay -->
<div class="site-overlay"></div>
<?php 
}
?>
<div id="wrapper" class="container">
<?php 
    $menuID=isset($g['menuIDs'])?$g['menuIDs']:$menuID;
    //require_once( __DIR__."/CheckWeekNo.php");
    $actionFile='menu/menu'.$menuID.'.php';
    include $actionFile;
?>
</div>
