<?php

use report\tool\image;
use report\user\product;

$result=array();
$category='';
$key=array_search($prodID,$data1);
$value=$data2[$key];
$categoryList='<a href=\"#\" onclick="handler0(\'1\'); return false;" style=\"text-decoration:none;\">HOME</a>>商品介紹>';
$category=$value;

$result = product::getProductList($prodID);

//$result['data']=array();
?>
<div>
		<div>
			<font style="font-size:30pt">商品介紹</font>
		</div>
		<div>
			<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
		</div>
		<div>
			<font style="font-size: 12px"><?=$categoryList?>><font style="color:red"><?=$category?></font></font>
		</div>
	</div>
<?php 
$obj=image::checkCategoryImage($prodID);
$ct=$obj['code'];
if ($ct>0){
    $fName=$obj['fName'];
?>
<!--  
	<div style="text-align: center;">
		<img src="assets/images/product/<?=$prodID?>/<?=$fName?>" style="width:50%;vertical-align: top;">
	</div>
-->
<?php 
}
else{
?>
<!-- 	<div id="banner"> -->
<!--   		<div id="myCarousel" class="carousel slide" data-ride="carousel"> -->
	    <!-- Indicators -->
<!-- 		    <ol class="carousel-indicators"> -->
<!-- 		      <li data-target="#myCarousel" data-slide-to="0" class="active"></li> -->
<!--     		  <li data-target="#myCarousel" data-slide-to="1"></li> -->
<!--     		  <li data-target="#myCarousel" data-slide-to="2"></li> -->
<!--     		</ol> -->

    	<!-- Wrapper for slides -->
<!--     		<div class="carousel-inner"> -->
<!--       			<div class="item active"> 
      			  <img src="<?=WEB_ASSET_URL?>images/main/banner/banner1.png" alt="Los Angeles" style="width:100%;">
       			</div> -->

<!--       			<div class="item"> 
        			<img src="<?=WEB_ASSET_URL?>images/main/banner/banner2.png" alt="Chicago" style="width:100%;">
      			</div> -->
<!--       			<div class="item"> 
        			<img src="<?=WEB_ASSET_URL?>images/main/banner/banner3.png" alt="New york" style="width:100%;">
      			</div> -->
<!--     		</div> -->

    	<!-- Left and right controls -->
<!--     		<a class="left carousel-control" href="#myCarousel" data-slide="prev"> -->
<!--       			<span class="glyphicon glyphicon-chevron-left"></span> -->
<!--       			<span class="sr-only">Previous</span> -->
<!--     		</a> -->
<!--     		<a class="right carousel-control" href="#myCarousel" data-slide="next"> -->
<!--     		  <span class="glyphicon glyphicon-chevron-right"></span> -->
<!--     		  <span class="sr-only">Next</span> -->
<!--    			 </a> -->
<!--   		</div>	 -->
<!--   	</div> -->
<?php     
}
?>
 
  	<div class="prod">
  		<div class="row">
<?php 
$data=$result['data'];
foreach( $data as $row ){
    $prod_no=$row['prodNO'];
    $prod_name=$row['prodName'];
//     $len = mb_strlen($prod_name,'gb2312');
//     if ($len<30){
//         for ($i=0;$i<30-$len;$i++){
//             $prod_name = $prod_name ."&nbsp;";
//         }
//     }
//     else{
//         $prod_name=mb_substr($prod_name,0,30,'gb2312');
//     }
    $prod_name=strtolower($prod_name);
    $sug_price=$row['sugPrice'];
    $prod_unit=$row['prodUnit'];
    $comp_price=$row['COMP_PRICE'];
    $mb_price=$row['mbPrice'];
    $pic=$row['pic'];
//     $pic3=$row['pic3'];
//     $pic1=$row['pic1'];
    $pic1='';
    $pic3='';
    $pic2=$row['pic2'];
    $status=$row['chk'];
    $netPrice=$row['COST'];
    if ($pic1==''){
        //$pic=WEB_ASSET_URL.'images/main/limit2.png';
        $pic=product::getProductImagePath($prod_no);
    }
    if ($netPrice==0){
        $netPrice = $sug_price;
    }
    $statusCode='';
    switch ($status){
        case "N"://已銷售
//             $statusCode=WEB_ASSET_URL.'images/main/preSale.png';
            $statusCode='';
            $status=0;
            break;
        DEFAULT://未銷售
            $statusCode='';
            $status=0;
            break;
    }
    ?>
  			<div class="col-xs-6 col-md-3">
  				
  				<a href="#" onclick="handlerProduct('a','<?=$prod_no?>'); return false;" style="text-decoration:none;">
    			<div class="colIMG">
    				<div class="imgOne"><img class="imageOne" src="<?=$pic?>"></div>
    <?php
    if ($status>0){
    ?>
    				<div class="imgThree"><img src="<?=$statusCode?>"></div>
    <?php 
    }
    else{
    ?>
				    <!-- 
    			     	<div class="imgThree"><img src="<?=WEB_ASSET_URL?>images/main/preSale.png"></div>
                     -->
    <?php
    }
    ?>
    			</div>
    			<div class="limitP1 text-center">
    				
    				
    				<div class="prodName">
    					<!--
    					   <div><font style="font-size:15pt"><?=$prod_no?></font></div> 
    					 -->
    					<div class="prodNameB" style="word-wrap:break-word"><font class="prodNameA"  style="font-size:15pt"><?=$prod_name?></font></div>
    					<div><font style="font-size:12pt">建議售價:<?=$sug_price?></font></div>
<?php 
$showTag=false;
if($showTag){
?>    					
    					<div><font style="font-size:12pt">會員價:<?=$mb_price?></font></div>
<?php 
}
?>
    				</div>
    				
    			</div>
    			</a>
  			</div>
<?php 
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
  	if (x<400){
  		if(navigator.userAgent.indexOf("Firefox") != -1 ) {
  			w=(y-40).toString() + "pt";
  		}
 		$(".limitP1").css({"width":z});
 		$(".limitP1").css({"padding-top":10});
		$(".prodNameA").css({"font-size":"10pt"});
		$(".prodNameB").css({"width":w});
		$(".prodName").css({"text-align": "left"});
// 		
//  			$(".prodName").css({"text-align": "left"});
// 		}
	}
  	</script>