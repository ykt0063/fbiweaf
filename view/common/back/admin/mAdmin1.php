<?php
use report\user\Auth;

if (Auth::isAdmin()>-1){
    $tag='';
    if (Auth::isAdmin()==0){
        $tag='disabled';
    }
?>
<script>
function checkBanner()
{
	var banner1 = $.trim($('#BannerFile1').val());
	var banner2 = $.trim($('#BannerFile2').val());
	var banner3 = $.trim($('#BannerFile3').val());
	//var verifyCode = $.trim($('#verifyCode').val());
	if(banner1 == '' || banner2 == '' ||banner3 == ''){
		alert('請選擇上傳檔案');
		return;
	}
	var form_data = new FormData();
	if (banner1 !=''){
		form_data.append("banner1", document.getElementById('BannerFile1').files[0]);
	}
	if (banner2 !=''){
		form_data.append("banner2", document.getElementById('BannerFile2').files[0]);
	}
	if (banner3 !=''){
		form_data.append("banner3", document.getElementById('BannerFile3').files[0]);
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
				<img src="assets/images/main/banner1.png"  class="img-responsive">				
			</div>				
			<div class="custom-file">
	   			<input type="file" class="custom-file-input" id="BannerFile1" name="BannerFile1" <?=$tag?>>
			    <label class="custom-file-label" for="BannerFile1">選擇BANNER1檔案...</label>
			</div>
		</div>
		<br>
		<div>
			<div id="banner2">		
				<img src="assets/images/main/banner2.png"  class="img-responsive">				
			</div>
			<div class="custom-file">
    			<input type="file" class="custom-file-input" id="BannerFile2" name="BannerFile2" <?=$tag?>>
			    <label class="custom-file-label" for="BannerFile2">選擇BANNER2檔案...</label>
  			</div>
		</div>
		<br>
		<div>
			<div id="banner3">				
				<img src="assets/images/main/banner3.png"  class="img-responsive">				
			</div>
			<div class="custom-file">
    			<input type="file" class="custom-file-input" id="BannerFile3" name="BannerFile3" <?=$tag?>>
			    <label class="custom-file-label" for="BannerFile3">選擇BANNER3檔案...</label>
  			</div>
		</div>
		<button type="button" class="btn btn-primary btn-md" onclick="checkBanner()">上傳</button>
	</form>
</div>
<?php 
}
?>