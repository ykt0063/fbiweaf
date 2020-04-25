<?php
//UTF-8編碼
//header('Content-Type: text/html; charset=utf-8');
$storeID=$_POST['storeid'];
$storeName=$_POST['storename'];
$stroeAddr=$_POST['storeaddress'];
$tmpVar=$_POST['TempVar'];
?>
<form id="receiveForm" action="../index.php" enctype="multipart/form-data" method="POST" >
	<input type="hidden" id="menuID" name="menuID" value="pay">
	<input type="hidden" id="payStep" name="payStep" value="0">
	<input type="hidden" id="storeID" name="storeID" value="<?=$storeID?>">
    <input type="hidden" id="storeName" name="storeName" value="<?=$storeName?>">
    <input type="hidden" id="stroeAddr" name="stroeAddr" value="<?=$stroeAddr?>">
    <button type="submit" class="btn  btn btn-danger">
    	<span class=""><div style="font-size:15pt">下一階段</div></span>
    </button>
</form>
<script> 
setTimeout(
        function()
        {
          //do something special
      	  document.getElementById('receiveForm').submit();
        }, 100);	 
</script>