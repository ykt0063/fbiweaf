<?php
use report\user\Auth;

if (Auth::isAdmin()>-1){
    $tag='';
    if (Auth::isAdmin()==0){
        $tag='disabled';
    }
    ?>
<script>
function checkCategory()
{
	var category = $.trim($('#CategoryFile').val());
	//var verifyCode = $.trim($('#verifyCode').val());
	if(category == ''){
		alert('請選擇上傳檔案');
		return;
	}
	var form_data = new FormData();
	if (category !=''){
		var cFile=document.getElementById('CategoryFile');
		var len = cFile.files.length;
		for (var i=0;i<len;i++){
			form_data.append("category[]", cFile.files[i]);
		}
	}
	var parameterStr = $('#setCategory').serialize();
	$.ajax({
    	type: "POST",
        url: defUrl+"ajax/setCategoryImage.php",
        //data: parameterStr,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        
        dataType:'json',
        success: function(data) {
            if(data['code'] == 1){
            		alert('產品分類圖 已設定完成');
            		location.replace(defUrl+"index.php?menuID=22");
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
	<form class="was-validated" id="setCategory" name="setCategory" enctype="multipart/form-data" action="index.php" method="POST">
	    <div>
			<div>
				<font style="font-size:30pt">設定產品分類圖</font>
			</div>
			<div>
				<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
			</div>
			<div>
				<font style="font-size: 12px">HOME>會員中心>管理功能><font style="color:red">設定產品分類圖</font></font>
			</div>
		</div>
		<div>						
			<div class="custom-file">
	   			<input type="file" class="custom-file-input" id="CategoryFile" name="CategoryFile" multiple <?=$tag?>>
			    <label class="custom-file-label" for="CategoryFile">選擇產品類別圖檔案...</label>
			</div>
		</div>
		<button type="button" class="btn btn-primary btn-md" onclick="checkCategory()">上傳</button>
	</form>
</div>
<?php 
}
?>