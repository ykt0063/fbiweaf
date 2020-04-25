<?php 
use report\tool\ShoppingCart;
use report\user\Auth;
$menuID = array_key_exists('menuID',$g)?$g['menuID']:$defaultMenuID;
$weekNo1=isset($g['WeekNo'])?$g['WeekNo']:'';
?>
<head>
<meta charset="utf-8">
<title>星意購物網站</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="assets/css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-width: 1920px)" href="assets/css/widescreen.css">
<link rel="stylesheet" media="screen and (max-width: 1000px)" href="assets/css/smallscreen.css">
<link rel="stylesheet" media="screen and (max-width: 600px)" href="assets/css/extsmallscreen.css">
<script src="assets/js/tool.js"></script>
<?php 
if (($menuID=='4' || $menuID=='6')&$weekNo1!=''){
?>
  <script src="<?=WEB_ASSET_URL?>js/jstree.min.js"></script>
  <link rel="stylesheet" href="<?=WEB_ASSET_URL?>dist/themes/default/style.min.css" />
  <script>
	$(document).ready(function(){
        $('.table-responsive').css('overflow-y', 'hidden');
	});
    $(function () {
  	  // 6 create an instance when the DOM is ready
  	  //$('#jstree').jstree("set_theme","default-dark");
      $('#jstree').jstree();
  	  $('#jstree').jstree().open_all();
  	  $('#jstree').jstree().hide_icons ();
  	  // 7 bind to events triggered on the tree
  	  $('#jstree').on("changed.jstree", function (e, data) {
  	    console.log(data.selected);
  	  });
  	  $('button').on('click', function () {
  	    $('#jstree').jstree(true).select_node('child_node_1');
  	    $('#jstree').jstree('select_node', 'child_node_1');
  	    $.jstree.reference('#jstree').select_node('child_node_1');
  	  });
//   	  $('.jstree-anchor>font').hover(
//   	  	function(){
//   	    	$(this).css("color", "black");
//       	}, 
//       	function(){
//       		$(this).css("color", "white");
// 	  	}
// 	  );
//   	$('.jstree-clicked>font').hover(
//   	  	  	function(){
//   	  	    	$(this).css("color", "black");
//   	      	}, 
//   	      	function(){
//   	      		$(this).css("color", "black");
//   		  	}
//   		  );
  	});
  </script>
<?php
}
else if($menuID==5){
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php 
}
?>
<script>
	var defUrl = "<?=WEB_SITE_URL?>";
  $( document ).ready(function() {
<?php 
if ($menuID==1 && !Auth::isLogin()){
?>		  
  	$('#image1')
       	.mouseover(function () {
       		$(this).attr("src", "assets/images/MB2.jpg");
   		})
       	.mouseout(function () {
       		$(this).attr("src", "assets/images/MB1.jpg");
   		});
  	$('#image2')
       	.mouseover(function () {
       		$(this).attr("src", "assets/images/SC2.jpg");
   		})
       	.mouseout(function () {
       		$(this).attr("src", "assets/images/SC1.jpg");
   		});
<?php 
}
if($menuID==1){
?>
   	var x = $( window ).width();
   	if (x>980){
   		$(".temp").html("<br><br><br><br><br><br>");
   	}
   	if (x>975){
   		$("head").append($("<link rel='stylesheet' href='assets/css/chorder.css' type='text/css' media='screen' />"));
   	}
   	$(window).on("orientationchange",function(){
		location.reload();	
	});
   	if(!isSmartPhone()&& !isTablet()){
		$( window ).resize(function() {
      			location.reload();
    		});
    		document.addEventListener('keydown', function (event) {
  			if ((event.ctrlKey === true || event.metaKey === true)
       				&& (event.which === 61 || event.which === 107
          			|| event.which === 173 || event.which === 109
          			|| event.which === 187 || event.which === 189)){
            			event.preventDefault();
          			location.reload();
     			}
		}, false);
	}
<?php 
}
?>
  });
</script>	
</head>
