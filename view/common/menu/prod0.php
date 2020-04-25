<?php

use report\tool\image;
use report\user\Auth;
use report\user\product;

$result=array();
$result=product::getProductTypes();
$result1 = product::getProductListA('');
$obj=image::getBanner();
?>
<p id='tagForProd0'></p>
<script>

var str1="	<div>\n";
str1=str1+"		<div>\n";
str1=str1+"			<font style='font-size:30pt'>商品分類</font>\n";
str1=str1+"		</div>\n";
str1=str1+"	<div>\n";
str1=str1+"		<img src='assets/images/login/contentHLine.png' style='width:100%;vertical-align: top;'>\n";
str1=str1+"	</div>\n";
str1=str1+" <div>\n";
str1=str1+"		<font style='font-size: 12px'>商品分類><font style='color:red'>全部分類</font></font>\n";
str1=str1+"	</div>\n";
var x =  $( window ).width();
if (x<757){
	document.getElementById("tagForProd0").innerHTML = str1;
}

</script>
<div id="tmpD"></div>
<div id="banner">
  		<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="8000">
	    <!-- Indicators -->
		    <ol class="carousel-indicators">
<?php 
for ($i=0;$i<sizeof($obj);$i++){
    $act='';
    if ($i==0){
        $act='active';
    }
?>
		      <li data-target="#myCarousel" data-slide-to="<?=$i?>" class="<?=$act?>"></li>
<?php 
}
?>
    		</ol>

    	<!-- Wrapper for slides -->
    		<div class="carousel-inner">
<?php 

for($i=0;$i<sizeof($obj);$i++){
    $fName=$obj[$i][0];
    $pID=$obj[$i][1];
    $act='';
    if ($i==0){
        $act='active';
    }
?>
				<div class="item <?=$act?>">
<?php
    if (in_array($pID,$result1)){
?>
      			  <a href="#" onclick="handlerProduct('a','<?=$pID?>'); return false;" style="text-decoration:none;">
<?php         
    }
    else{
        if (!Auth::isLogin()){
?>
				  <a href="#" onclick="handler('1'); return false;" style="text-decoration:none;">
<?php 
        }
        else{
?>
				 <a href="">
<?php 
        }
?>
<?php 
    }
?>
      			  <img src="<?=WEB_ASSET_URL?>images/main/banner/<?=$fName?>" alt="Los Angeles" style="width:100%;">
      			  </a>
      			</div>
<?php 
}
?>
    		</div>

    	<!-- Left and right controls -->
    		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
      			<span class="glyphicon glyphicon-chevron-left"></span>
      			<span class="sr-only">Previous</span>
    		</a>
    		<a class="right carousel-control" href="#myCarousel" data-slide="next">
    		  <span class="glyphicon glyphicon-chevron-right"></span>
    		  <span class="sr-only">Next</span>
   			 </a>
  		</div>	
  	</div>
  	<div class="prod">
  		<div class="row">
<?php 
$data=$result['data'];
foreach( $data as $row ){
    $type_no=$row['typeNO'];
    $type_name=$row['typeName'];
    $pic=$row['pic'];
    $statusPath='';
    if (strcmp($type_no,substr($pic,0,2))==0){
        $picPath=product::getProductImagePaths($type_no,$pic);
?>
  			<div class="col-xs-6 col-md-3">
  				<br>
  				<a href="#" onclick="handlerProd('<?=$type_no?>'); return false;" style="text-decoration:none;">
    			<div class="colIMG">
    				<div class="imgOne"><img class="imageOne" src="<?=$picPath?>"/></div>
    				<div class="imgThree"><img src="<?=$statusPath?>"></div>
    			</div>
    			<div class="limitP1">
    				
    				
    				<div class="prodName" style="text-align: center;">
    					<div><font style="font-size:15pt"></font></div>
    					<div class="prodNameB" style="word-wrap:break-word"><font class="prodNameA" style="font-size:15pt"><?=$type_name?></font></div>
    					<div><font style="font-size:12pt"></font></div>
    				</div>
    				
    			</div>
    			</a>
  			</div>
<?php 
    }
}
?>
  		</div>
  	</div>
  	<script>
  	var x =  $( window ).width();
  	//document.getElementById("tmpD").innerHTML = "width is" +x.toString()+"<br>\n";
  	var y=Math.round(x/2-30);
  	var z=(y-20).toString() + "pt";
  	var w=(y-20).toString() + "pt";
  	var u=(y-20).toString() + "pt";
  	$(".prodName").css({"height": "40pt"});
  	if (x<400){
  		if(navigator.userAgent.indexOf("Firefox") != -1 ) {
  			w=(y-40).toString() + "pt";
  		}
 		$(".limitP1").css({"width":z});
 		$(".limitP1").css({"padding-top":10});
		$(".prodNameA").css({"font-size":"10pt"});
		$(".prodNameB").css({"width":w});
		$(".prodName").css({"text-align": "left"});
		$(".prodName").css({"height": "20pt"});
		
// 		
//  			$(".prodName").css({"text-align": "left"});
// 		}
	}
  	</script>
