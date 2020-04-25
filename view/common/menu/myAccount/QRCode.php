<?php
use report\user\Session;

$checkCode=Session::get('checkCode');
$name=Session::get('name');
//$urlToEncode=WEB_SITE_URL."index.php?menuID=2&ckc=".$checkCode."&n=".$name;
$urlToEncode=WEB_SITE_URL."index.php?menuID=2&ckc=".$checkCode."&n=xxx";
$strlen=strlen($urlToEncode);
?>
您的QRCode如下：<br>
<p>
<?php 
generateQRwithGoogle($urlToEncode);
function generateQRwithGoogle($url,$widthHeight ='150',$EC_level='L',$margin='0') {
    $url = urlencode($url);
    echo '<img src="http://chart.apis.google.com/chart?chs='.$widthHeight.
    'x'.$widthHeight.'&cht=qr&chld='.$EC_level.'|'.$margin.
    '&chl='.$url.'" alt="QR code" widthHeight="'.$widthHeight.
    '" widthHeight="'.$widthHeight.'"/>';
}
?>
</p>
<p>
<!-- The text field -->
<input type="text" value=<?=$urlToEncode?> id="myInput" size="<?=$strlen?>" readonly>

<!-- The button used to copy the text -->
<button onclick="myFunction()">複製</button>
</p>
<script>
function myFunction() {
  /* Get the text field */
  var input = document.getElementById("myInput");
  if (navigator.userAgent.match(/ipad|ipod|iphone/i)) {
        var editable = input.contentEditable;
        var readOnly = input.readOnly;

        input.contentEditable = true;
        input.readOnly = false;

        var range = document.createRange();
        range.selectNodeContents(input);

        var selection = window.getSelection();
        selection.removeAllRanges();
        selection.addRange(range);

        input.setSelectionRange(0, 999999);
        input.contentEditable = editable;
        input.readOnly = readOnly;

        //document.body.removeChild(input);
  } else {
     input.select();
     input.setSelectionRange(0, 99999); /*For mobile devices*/
  }
  /* Select the text field */
  //copyText.select();
  //copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  //alert("Copied the text: " + copyText.value);
}
</script>
