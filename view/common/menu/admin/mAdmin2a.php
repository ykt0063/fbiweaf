<?php
use report\user\Auth;

if (Auth::isAdmin()>-1){
    $tag='';
    if (Auth::isAdmin()==0){
        $tag='disabled';
    }
    ?>
<script>
function checkP12(){
	var p12Same=$('#p12Same');
	if (p12Same.prop('checked')){
		$('#Product2File').prop('disabled', true);
	}
	else{
		$('#Product2File').prop('disabled', false);
	}
}
function checkProduct()
{
	var p1 = $.trim($('#Product1File').val());
	var p2 = $.trim($('#Product2File').val());
	var p3 = $.trim($('#Product3File').val());
	var p4 = $.trim($('#Product4File').val());
	var checkP12 = $('#p12Same').prop('checked');
	var tag=true;
	
	//var verifyCode = $.trim($('#verifyCode').val());
	if ((p1.legnth==0) && ((p1.length==0)&&(checkP12==false)&&(p2.length==0))&&(p3.length==0)&&(p4.length==0)){
		tag=false;
	}
	if (tag){
		var form_data = new FormData();
		if (p1.length>0){
			var p1File=document.getElementById('Product1File');
			var len = p1File.files.length;
			for (var i=0;i<len;i++){
				form_data.append("Product1File[]", p1File.files[i]);
			}
			form_data.append("Product1TAG", true);
		}
		else{
			form_data.append("Product1TAG", false);
		}
		if (checkP12)
			form_data.append("checkP12", '1');
		else
			form_data.append("checkP12", '0');
		if (checkP12==false){
			if (p2.length>0){
				var p2File=document.getElementById('Product2File');
				var len = p2File.files.length;
				for (var i=0;i<len;i++){
					form_data.append("Product2File[]", p2File.files[i]);
				}
				form_data.append("Product2TAG", true);
			}
			else{
				form_data.append("Product2TAG", false);
			}
		}
		else{
			form_data.append("Product2TAG", false);
		}
		if (p3.length>0){
			var p3File=document.getElementById('Product3File');
			var len = p3File.files.length;
			for (var i=0;i<len;i++){
				form_data.append("Product3File[]", p3File.files[i]);
			}
			form_data.append("Product3TAG", true);
		}		
		else{
			form_data.append("Product3TAG", false);
		}
		if (p4.length>0){
			var p4File=document.getElementById('Product4File');
			var len = p4File.files.length;
			for (var i=0;i<len;i++){
				form_data.append("Product4File[]", p4File.files[i]);
			}
			form_data.append("Product4TAG", true);
		}		
		else{
			form_data.append("Product4TAG", false);
		}
		var parameterStr = $('#setProductImage').serialize();
		$.ajax({
	    	type: "POST",
	        url: defUrl+"ajax/setProductImage.php",
	        //data: parameterStr,
	        data: form_data,
	        cache: false,
	        contentType: false,
	        processData: false,
	        
	        dataType:'json',
	        success: function(data) {
	            if(data['code'] == 1){
	            		alert('productImage檔案已更新');
	            		WebTool.webPageLocation(defUrl+"index.php?menuID=22a");
	            }else{
						alert(data['desc']);
						//alert('影像檔案不正確,請重新上傳');
	            }
	        },
	        error:function(xhr, ajaxOptions, thrownError){
	            alert(thrownError);
	 		}
	    });
	}
	else{
		alert("請選擇檔案上傳");
	}	
    return;
}
</script>
<div style="min-height: 700px;">
	<form class="was-validated" id="setProductImage" name="setProductImage" enctype="multipart/form-data" action="index.php" method="POST">
	    <div>
			<div>
				<font style="font-size:30pt">設定產品圖片</font>
			</div>
			<div>
				<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
			</div>
			<div>
				<font style="font-size: 12px">HOME>會員中心>管理功能><font style="color:red">設定產品圖片</font></font>
			</div>
		</div>
		<div>					
			<div class="custom-file">
				<label class="custom-file-label" for="Product1File">選擇產品大圖檔案...</label>
	   			<input type="file" class="custom-file-input" id="Product1File" name="Product1File" multiple <?=$tag?>>			    
			</div>
			<br>
			<div class="custom-file">
	   			小圖使用大圖<input name="p12Same" type="checkbox" id="p12Same" onclick="checkP12()">
			</div>			
			<div class="custom-file">
	   			<label class="custom-file-label" for="Product2File">選擇產品小圖檔案...</label>
	   			<input type="file" class="custom-file-input" id="Product2File" name="Product2File" multiple <?=$tag?>>
			</div>
			<br>
			<div class="custom-file">
			    <label class="custom-file-label" for="Product3File">選擇產品特性圖檔案...</label>
	   			<input type="file" class="custom-file-input" id="Product3File" name="Product3File" multiple <?=$tag?>>
			</div>
			<div class="custom-file">
			    <label class="custom-file-label" for="Product4File">選擇產品規格圖檔案...</label>
	   			<input type="file" class="custom-file-input" id="Product4File" name="Product4File" multiple <?=$tag?>>
			</div>
		</div>
		<br>
		<button type="button" class="btn btn-primary btn-md" onclick="checkProduct()">上傳</button>
	</form>
</div>
<?php 
}
?>