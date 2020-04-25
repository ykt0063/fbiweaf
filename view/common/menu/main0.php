<?php 

use report\order\Products;

$res=array();
$res[]=Products::getProductActivity(1);//limitTime
$res[]=Products::getProductActivity(2);//hot
$res[]=Products::getProductActivity(3);//spec
$prods=array();
$tags=array();
for ($k=0;$k<3;$k++){
    if ($res[$k]['code']==0){
        $data=$res[$k]['data'];
        $lProd=array();
        $ct=0;
        foreach($data as $key => $row){
            $lProd[]=$row;
        }
        $prods[]=$lProd;
        $tags[]=true;
    }
    else{
        $tags[]=false;
        $prods[]=null;
    }
}

?>
  	<div id="banner">
  		<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="8000">
	    <!-- Indicators -->
		    <ol class="carousel-indicators">
		      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    		  <li data-target="#myCarousel" data-slide-to="1"></li>
    		  <li data-target="#myCarousel" data-slide-to="2"></li>
    		</ol>

    	<!-- Wrapper for slides -->
    		<div class="carousel-inner">
      			<div class="item active">
      			  <img src="<?=WEB_ASSET_URL?>images/main/banner/banner1.png" alt="Los Angeles" style="width:100%;">
      			</div>

      			<div class="item">
        			<img src="<?=WEB_ASSET_URL?>images/main/banner/banner2.png" alt="Chicago" style="width:100%;">
      			</div>
      			<div class="item">
        			<img src="<?=WEB_ASSET_URL?>images/main/banner/banner3.png" alt="New york" style="width:100%;">
      			</div>
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
    <br><br><br>
    <div id="limitTime">
    	<div class="row">
    		<div class="col-md-5-cols">
    			<p class="text-center"  style="width:170px">
    				<font style="font-size:13pt">
    					活動時間:<span id="timeRange"><?=$limitTimeBeginStr?> ~ <?=$limitTimeEndStr ?></span>
    				</font>
    			</p>
    		</div>
    		<div class="col-md-20-cols">
    			<div class="text-center">
    			    <font style="font-size:24pt;"><font style="text-decoration: line-through;">&nbsp;&nbsp;&nbsp;</font><font style="color:#88f7e1;">&nbsp;限時特賣</font><span class="glyphicon glyphicon-time" aria-hidden="true"></span> <font style="font-size:21pt">倒數</font><span id="countdown"></span>&nbsp;<font style="text-decoration: line-through;">&nbsp;&nbsp;&nbsp;</font></font>
    			</div>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-sm-4 col-md-5-cols">
    			<div id="limitBG">
    				<div class="colOneMore">
	    				<span>
    						<font style="font-size:30pt">限時特賣</font><br><br>
    						<font style="font-size:12pt">精選商品</font><br>
    						<a href="#" onclick="handler0('6'); return false;" style="text-decoration:none;">
    							<button type="button" class="btn btn-default"><font style="font-size:12pt">MORE ></font></button>
    						</a>
    					</span>
    				</div>
    			</div>
    		</div>
<?php 
if ($tags[0]){
    $prod=$prods[0];
    for ($i=0;$i<4;$i++){
        $row=$prod[$i];
        $image=$row['pic1'];
        $pName=$row['prodName'];
        $pNO=$row['prodNO'];
        $sCode=$row['statusCode'];
        $nPrice=$row['netPrice'];
        $sPrice=$row['sugPrice'];
        $pUnit=$row['prodUnit'];
        $pv=$row['PV'];
        $ranking=$row['ranking'];
        switch ($sCode){
            case 0:
                $saleStatus=WEB_ASSET_URL."images/main/onSale.png";
              break;  
            case 1:
                $saleStatus=WEB_ASSET_URL."images/main/preSale.png";
                break;
            case 2:
                $saleStatus=WEB_ASSET_URL."images/main/saleOut.png";
                break;
            case 3:
                $saleStatus=WEB_ASSET_URL."images/main/spotProduct.png";
                break;
        }
        switch ($i){
            case 0:
                $topStr=WEB_ASSET_URL.'images/main/limitTop1.png';
                break;
            case 2:
                $topStr=WEB_ASSET_URL.'images/main/limitTop2.png';
                break;
            case 3:
                $topStr=WEB_ASSET_URL.'images/main/limitTop3.png';
                break;
            case 4:
                $topStr=WEB_ASSET_URL.'images/main/limitTop4.png';
                break;
        }
?>
    		<div class="col-sm-4 col-md-5-cols">
    			<br>
    			<div class="colIMG">
    				<div class="imgOne"><img src="<?=$image?>"></div>
    				<div class="imgTwo"><img src="<?=$topStr?>"></div>
    				<div class="imgThree"><img src="<?=$saleStatus?>"></div>
    			</div>
    			<div class="limitP1" class="text-center">
    				<a href="#" onclick="handlerProduct('a','<?=$pNO?>'); return false;" style="text-decoration:none;">
	    				<div class="prodName" >
	    					<font style="font-size:15pt"><?=$pName?></font><br>
    						<font style="font-size:12pt">售價:<font style="text-decoration: line-through;"><?=$sPrice?>元</font></font><br>
    						<font style="font-size:15pt"><font style="color:red">網路價:<?$nPrice ?>元</font></font><br>    					
    					</div>
    				</a>
    			</div>
    		</div>
<?php 
    }
}
?>
    	</div>
    </div>
    <br>
    <div id="hot">
    	<div class="row">
    		<div class="col-sm-4 col-md-5-cols">
    			<div id="hotBG">
    				<div class="colOneMore">
	    				<span>
    						<font style="font-size:30pt">熱銷商品</font><br><br>
    						<font style="font-size:12pt">精選商品</font><br>
    						<a href="#" onclick="handler0('7'); return false;" style="text-decoration:none;">
    							<button type="button" class="btn btn-default"><font style="font-size:12pt">MORE ></font></button>
    						</a>
    					</span>
    				</div>
    			</div>
    		</div>
<?php 
if ($tags[1]){
    $prod=$prods[1];
    for ($i=0;$i<4;$i++){
        $row=$prod[$i];
        $image=$row['pic1'];
        $pName=$row['prodName'];
        $pNO=$row['prodNO'];
        $sCode=$row['statusCode'];
        $nPrice=$row['netPrice'];
        $sPrice=$row['sugPrice'];
        $pUnit=$row['prodUnit'];
        $pv=$row['PV'];
        $ranking=$row['ranking'];
        switch ($sCode){
            case 0:
                $saleStatus=WEB_ASSET_URL."images/main/onSale.png";
              break;  
            case 1:
                $saleStatus=WEB_ASSET_URL."images/main/preSale.png";
                break;
            case 2:
                $saleStatus=WEB_ASSET_URL."images/main/saleOut.png";
                break;
            case 3:
                $saleStatus=WEB_ASSET_URL."images/main/spotProduct.png";
                break;
        }
        switch ($i){
            case 0:
                $topStr=WEB_ASSET_URL.'images/main/hotTop1.png';
                break;
            case 2:
                $topStr=WEB_ASSET_URL.'images/main/hotTop2.png';
                break;
            case 3:
                $topStr=WEB_ASSET_URL.'images/main/hotTop3.png';
                break;
            case 4:
                $topStr=WEB_ASSET_URL.'images/main/hotTop4.png';
                break;
        }
?>    		
    		<div class="col-sm-4 col-md-5-cols">
    			<br>
    			<div class="colIMG">
    				<div class="imgOne"><img src="<?=$image?>"></div>
    				<div class="imgTwo"><img src="<?=$topStr?>"></div>
    				<div class="imgThree"><img src="<?=$saleStatus?>"></div>
    			</div>
    			<div class="limitP1" class="text-center">
    				<a href="#" onclick="handlerProduct('a','<?=$pNO?>'); return false;" style="text-decoration:none;">
    					<div class="prodName">
    						<font style="font-size:15pt"><?=$pName?></font><br>
    						<font style="font-size:12pt">售價:<font style="text-decoration: line-through;"><?=$sPrice?>元</font></font><br>
    						<font style="font-size:12pt"><font style="color:red">網路價:<?=$nPrice?>元</font></font><br>
    					</div>
    				</a>
    			</div>
    		</div>
<?php 
    }
}
?>
    		
    	</div>
    </div>
    <br>
    <div id="spec">
    	<div class="row">
    		<div class="col-xs-12 col-sm-4 col-md-5-cols ">
				<div id="specBG">
    				<div class="colOneMore">
	    				<span>
    						<font style="font-size:30pt">本月特惠</font><br><br>
    						<font style="font-size:12pt">精選商品</font><br>
    						<a href="#" onclick="handler0('8'); return false;" style="text-decoration:none;">
	    						<button type="button" class="btn btn-default"><font style="font-size:12pt">MORE ></font></button>
	    					</a>
    					</span>
    				</div>
    			</div>
    		</div>
<?php 
if ($tags[2]){
    $prod=$prods[2];
    for ($i=0;$i<4;$i++){
        $row=$prod[$i];
        $image=$row['pic1'];
        $pName=$row['prodName'];
        $pNO=$row['prodNO'];
        $sCode=$row['statusCode'];
        $nPrice=$row['netPrice'];
        $sPrice=$row['sugPrice'];
        $pUnit=$row['prodUnit'];
        $pv=$row['PV'];
        $ranking=$row['ranking'];
        $discount=$row['discount'];
        switch ($discount){
            case 95:
                $saleStatus=WEB_ASSET_URL."images/main/specDisct95.png";
              break;  
            case 90:
                $saleStatus=WEB_ASSET_URL."images/main/specDisct90.png";
                break;
            case 85:
                $saleStatus=WEB_ASSET_URL."images/main/specDisct85.png";
                break;
            case 80:
                $saleStatus=WEB_ASSET_URL."images/main/specDisct80.png";
                break;
            case 75:
                $saleStatus=WEB_ASSET_URL."images/main/specDisct75.png";
                break;
            case 70:
                $saleStatus=WEB_ASSET_URL."images/main/specDisct70.png";
                break;
            case 65:
                $saleStatus=WEB_ASSET_URL."images/main/specDisct65.png";
                break;
            case 60:
                $saleStatus=WEB_ASSET_URL."images/main/specDisct60.png";
                break;
            case 55:
                $saleStatus=WEB_ASSET_URL."images/main/specDisct55.png";
                break;
        }
?> 
    		<div class="col-xs-12 col-sm-4 col-md-5-cols">
    			<br>
    			<div class="colIMG">
    				<div class="imgOne"><img src="<?=$image?>"></div>
    				<div class="imgTwo"><img src="<?=$saleStatus?>"></div>
    			</div>
    			<div class="limitP1" class="text-center">
    				<a href="#" onclick="handlerProduct('a','<?=$pNO?>'); return false;" style="text-decoration:none;">
	    				<div class="prodName">
	    					<font style="font-size:15pt"><?=$pName?></font><br>
	    					<font style="font-size:12pt">售價:<font style="text-decoration: line-through;"><?=$sPrice?>元</font></font><br>
	    					<font style="font-size:15pt"><font style="color:red">網路價:<?=$nPrice?>元</font></font><br>
	    				</div>
	    			</a>
    			</div>
    		</div>
<?php 
    }
}
?>
    	</div>
    </div>
    <br>
    <div id="share">
    	<div class="row">
    		<div class="col-md-2"><font style="font-size:18px">見證分享</font></div>
    		<div class="col-md-2 col-md-offset-8 text-right"><a id="shareA" href="#"><font style="font-size:12px">MORE></font></a></div>
    	</div>
    	<div>
	    	<img src="<?=WEB_ASSET_URL?>images/main//share_bg.png" style="width:100%;vertical-align: top;">
    	</div>
    	<div class="row">
    		<div class="col-xs-12 col-sm-6 col-md-4">
    			<div class="shareSet">
    				<div class="shareIMG">
	    				<img src="<?=WEB_ASSET_URL?>images/main//share1.png">
	    			</div>
	    			<div class="shareMask">
	    				<img src="<?=WEB_ASSET_URL?>images/main//shareMask.png">
	    			</div>
	    			<div class="shareContext" style="width:313px">
	    				<font style="font-size:12px">
    					[會員試用-美之凍]我的皮膚很缺水,我也覺得膠原蛋白漸漸流失,所以買了美之凍膠原蛋白,小資女也想每天有水潤好氣色^^
    					</font>
    					<img src="<?=WEB_ASSET_URL?>images/main//shareLine.png">
	    			</div>
    			</div>
    		</div>
    		<div class="col-xs-12 col-sm-6 col-md-4">
    			<div Class="shareSet">
					<div class="shareIMG">
						<img src="<?=WEB_ASSET_URL?>images/main//share2.png">
    				</div>
    				<div class="shareMask">
	    				<img src="<?=WEB_ASSET_URL?>images/main//shareMask.png">
	    			</div>
    				<div class="shareContext" style="width:313px">
	    				<font style="font-size:12px">
   						[會員試用-美之凍]我的皮膚很缺水,我也覺得膠原蛋白漸漸流失,所以買了美之凍膠原蛋白,小資女也想每天有水潤好氣色^^
						</font>
   						<img src="<?=WEB_ASSET_URL?>images/main//shareLine.png">
    				</div>
    			</div>
    		</div>
    		<div class="col-xs-12 col-sm-6 col-md-4">
    			<div Class="shareSet">
    				<div class="shareIMG">
	    				<img src="<?=WEB_ASSET_URL?>images/main//share3.png">
    				</div>
    				<div class="shareMask">
    					<img src="<?=WEB_ASSET_URL?>images/main//shareMask.png">
    				</div>
    				<div class="shareContext" style="width:313px">
	    				<font style="font-size:12px">
    					[會員試用-美之凍]我的皮膚很缺水,我也覺得膠原蛋白漸漸流失,所以買了美之凍膠原蛋白,小資女也想每天有水潤好氣色^^
						</font>
   						<img src="<?=WEB_ASSET_URL?>images/main//shareLine.png">
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
