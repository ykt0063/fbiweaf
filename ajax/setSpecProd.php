<?php
use report\order\Products;
use report\response\ReturnHandler;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

require_once( __DIR__."/../init.inc.php" );
$selMonth=isset($selMonth)?$selMonth:0;
$range=explode(':',$selMonth);
$activeBegin=$range[0];
$activeEnd=$range[1];
$ct=0;
for ($i=0;$i<40;$i++){
    $prodx='prod'.$i;
    $discx='disc'.$i;
    $prod=isset($$prodx)?$$prodx:0;
    $disc=isset($$discx)?$$discx:0;
    if ($prod!='0'){
        $ct=$ct+1;
        if ($i==0){
            $prodStr=$prod.":".$i.":".$disc;
        }
        else{
            $prodStr=$prodStr."|".$prod.":".$i.":".$disc;
        }
    }
}
$res=Products::setProductActivity(3, $activeBegin, $activeEnd, $prodStr, $ct);
if ($res==0){
    ReturnHandler::response(1);
}
else{
    ReturnHandler::response(32,null,'資料有錯誤');
}