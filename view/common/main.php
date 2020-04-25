<?php 

if ($mainID==0){
    include "menu/main0.php";
}
else if ($mainID==1) {//產品介紹
    include "menu/main1.php";
}
else if ($mainID==2) {//
    include "menu/main2.php";
}
else if ($mainID==3) {//關於我們
    include "menu/main3.php";
}
else if ($mainID==4) {//最新消息
    include "menu/main4.php";
}
else if ($mainID==5) {//見證分享
    include "menu/main5.php";
}
else if (($mainID==6)||($mainID==7)||($mainID==8)) {//6:顯示特賣, 7: 熱銷商品,8:本月特惠
    include "menu/main6.php";
}
else {
    include "menu/main0.php";
}
?>