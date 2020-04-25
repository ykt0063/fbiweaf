<?php
use report\tool\image;
use report\user\Auth;

if (Auth::isAdmin()>-1){
    $tag='';
    if (Auth::isAdmin()==0){
        $tag='disabled';
    }
    $obj=image::getBanner();
    $banner=array();
    $fID=array();
    for ($i=0;$i<sizeof($obj);$i++){
        $banner[]=$obj[$i][0];
        $fID[]=$obj[$i][1];
    }
?>
<script>
function disableBanner(){
	var divs= $("input[name='disableFile[]']:checked").map(function() { return $(this).val(); }).get();
	if (divs.length>0){
		var form_data = new FormData();
		for(i=0;i<divs.length;i++){
			form_data.append("banner[]", divs[i]);
		}
		var parameterStr = $('#setBanner1').serialize();
		$.ajax({
	    	type: "POST",
	        url: defUrl+"ajax/disableBanner.php",
	        //data: parameterStr,
	        data: form_data,
	        cache: false,
	        contentType: false,
	        processData: false,
	        
	        dataType:'json',
	        success: function(data) {
	            if(data['code'] == 1){
	            		alert('選定BANNER檔案已關閉');
	            		WebTool.webPageLocation(defUrl+"index.php?menuID=21");
	            }else{
						alert(data['desc']);
						//alert('影像檔案不正確,請重新上傳');
	            }
	        },
	        error:function(xhr, ajaxOptions, thrownError){
	            alert(thrownError);
	 		}
	    });
	    return;
	}
}
function checkBanner()
{
	var banner = $.trim($('#BannerFile').val());
	//var verifyCode = $.trim($('#verifyCode').val());
	if(banner == ''){
		alert('請選擇上傳檔案');
		return;
	}
	var form_data = new FormData();
	if (banner !=''){
		var bFile=document.getElementById('BannerFile');
		var len = bFile.files.length;
		for (var i=0;i<len;i++){
			form_data.append("banner[]", bFile.files[i]);
		}
	}
	var parameterStr = $('#setBanner').serialize();
	$.ajax({
    	type: "POST",
        url: defUrl+"ajax/setBanner.php",
        //data: parameterStr,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        
        dataType:'json',
        success: function(data) {
            if(data['code'] == 1){
            		alert('BANNER檔案已更新');
            		WebTool.webPageLocation(defUrl+"index.php?menuID=21");
            }else{
					alert(data['desc']);
					//alert('影像檔案不正確,請重新上傳');
            }
        },
        error:function(xhr, ajaxOptions, thrownError){
            alert(thrownError);
 		}
    });
    return;
}
</script>
<div style="min-height: 700px;">
	<form class="was-validated" id="setBanner" name="setBanner" enctype="multipart/form-data" action="index.php" method="POST">
	    <div>
			<div>
				<font style="font-size:30pt">設定BANNER</font>
			</div>
			<div>
				<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
			</div>
			<div>
				<font style="font-size: 12px">HOME>會員中心>管理功能><font style="color:red">設定BANNER</font></font>
			</div>
		</div>
		<div>		
			<div id="banner1">
				<img src="assets/images/main/banner/banner1.png"  class="img-responsive">				
			</div>				
			<div class="custom-file">
	   			<input type="file" class="custom-file-input" id="BannerFile" name="BannerFile" multiple <?=$tag?>>
			    <label class="custom-file-label" for="BannerFile1">選擇BANNER檔案...</label>
			</div>
		</div>
		<button type="button" class="btn btn-primary btn-md" onclick="checkBanner()">上傳</button>
	</form>
	<br>
	<form class="was-validated" id="setBanner1" name="setBanner1" enctype="multipart/form-data" action="index.php" method="POST">
		<div class="row">
<?php 
    for($i=0;$i<sizeof($banner);$i++){
    $fName=$banner[$i];
?>
				<div class="col-md-10 regwd">
					<img src='assets/images/main/banner/<?=$fName?>' width="960px">
					<input name="disableFile[]" type="checkbox" value="<?=$fName?>">關閉對應產品：<?=$fID[$i]?>			
				</div>

<?php 
    }
?>
		</div>
		<button type="button" class="btn btn-primary btn-md" onclick="disableBanner()">設定</button>
	</form>
</div>
<?php 
}
?>