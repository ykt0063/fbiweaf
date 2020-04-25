<?php
use report\user\Session;

?>
<script>
function myFunction() {
        if(!isSmartPhone()&& !isTablet()){
            setTimeout(
              function()
              {
                //do something special
                location.reload();
              }, 50);
        }
}
function isSmartPhone(){
        var ua=navigator.userAgent;
        if (ua.indexOf('iPhone')>0||(ua.indexOf('Android')>0 && ua.indexOf('Mobile')>0) || ua.indexOf('Windows Phone')>0){
                //alert("Is Smart Phone!!");
                return true;
        }
        else{
                //alert("Is not Smart Phone!!");
                return false;
        }
}
function isTablet(){
        var ua=navigator.userAgent;
        if (ua.indexOf('iPad')>0||(ua.indexOf('Android')>0 && ua.indexOf('Mobile')==-1)){
                //alert("Is Tablet!!");
                return true;
        }
        else{
                //alert("Is not Tablet!!");
                return false;
        }
}
</script>