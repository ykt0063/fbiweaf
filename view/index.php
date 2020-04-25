<?php 
// $mid = $_GET['mid'];
$mid = isset($g['menuID'])?$g['menuID']:0;
$mainID = isset($g['mainID'])?$g['mainID']:1;
// if ($mid==null){
//     $mid=0;
// }
if ($mid>=0){
    include "common/checkSC.php";
    include "common/header.php";
?>
<body style="background-color:white;" onresize="myFunction()">
<?php 
    include "common/forScript.php";
    include "common/hiddenForm.php";

    include "common/body.php";
    include "common/scData.php";
?>
<br>
<?php

    include "common/footer.php";
}
else{
    include "common/menu/singleForm.php";
}
?>
</div>
</body>
</html>

