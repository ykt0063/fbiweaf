<?php
use report\user\Auth;
?>
<div class="temp"></div>
<div id="banner">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
	    <!-- Indicators -->
	    <ol class="carousel-indicators">
	      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	      <li data-target="#myCarousel" data-slide-to="1"></li>
	      <li data-target="#myCarousel" data-slide-to="2"></li>
	    </ol>
	
	    <!-- Wrapper for slides -->
	    <div class="carousel-inner">
	    	<div class="item active">
	        	<img src="assets/images/banner1.jpg" alt="Los Angeles" style="width:100%;">
	     	</div>
	
	      	<div class="item">
	        	<img src="assets/images/banner2.jpg" alt="Chicago" style="width:100%;">
	      	</div>    
	      	<div class="item">
	        	<img src="assets/images/banner3.jpg" alt="New york" style="width:100%;">
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
<div id="abus">
	<div class="temp"></div>
  	<h2>關於我們</h2>
  	<span class="glyphicon glyphicon-star"></span>
  	<h2>About us</h2>
  	<br>
  	<div id="abus-detail">
  		<div class="row">
			<div class="col-md-6"><img src="assets/images/abs1.jpg"></div>
			<div class="col-md-6" align="left">
				<h3>
					伴隨著互聯網+時代來臨，衝擊著商業模式的洗牌瞬息萬變的市場行銷革命下， 如何捷足先登？是企業生存擴大的首要議題 因此，［星意科技］在一群業界領域菁英集結下孕育而出旗下兩大事業系統豐耀（ＳＴＹＬＥ）美學館連鎖及完美（ＰＥＲＦＥＣＴ　１０）行銷系統，囊括美學及健康各項產業，加上創新思維，跨界萬商聯盟，並致力將新經濟奇蹟推向國際舞台，建立共富，共榮，共業知新世紀。
				</h3>
			</div>
		</div>
		<div class="row" id="rowA">
			<div class="col-md-6"><img src="assets/images/abs2.jpg"></div>
			<div class="col-md-6" align="left">
				<h3>
					伴隨著互聯網+時代來臨，衝擊著商業模式的洗牌瞬息萬變的市場行銷革命下， 如何捷足先登？是企業生存擴大的首要議題 因此，［星意科技］在一群業界領域菁英集結下孕育而出旗下兩大事業系統豐耀（ＳＴＹＬＥ）美學館連鎖及完美（ＰＥＲＦＥＣＴ　１０）行銷系統，囊括美學及健康各項產業，加上創新思維，跨界萬商聯盟，並致力將新經濟奇蹟推向國際舞台，建立共富，共榮，共業知新世紀。
				</h3>
			</div> 		
			
  		</div>
  	</div>
</div>
<?php 
if (!Auth::isLogin()){
?>
<div id="affi">
  	<br><br><br>
    <div class="row">
    	<div class="col-md-6" align="right">
      		<div class="box" align="right">
      			<a href="#" onclick="handler('2'); return false;" style="text-decoration:none;"><img id="image1" src="assets/images/MB1.jpg"/></a>
      		</div>
      	</div>
      	<div class="col-md-6">
      		<div class="box"  align="left">
	      		<a href="#" onclick="handler('8'); return false;" style="text-decoration:none;"><img id="image2" src="assets/images/SC1.jpg"/></a>
	    	</div>
      	</div>
    </div>
</div>
<?php 
}
?>