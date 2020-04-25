<?php 
//echo "header(\"Location:\".WEB_SITE_URL/logout/);";
use report\user\Session;

Session::deleteAll();
clearstatcache();
?>
<script>
window.onload = function(e){ 
	location.href=<?php echo "'".WEB_SITE_URL."?p1=logout'"; ?>;
}
</script>