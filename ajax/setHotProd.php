<?php
use report\order\Products;
use report\response\ReturnHandler;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

require_once( __DIR__."/../init.inc.php" );
$ct=0;
for ($i=0;$i<40;$i++){
    $prodx='prod'.$i;
    $prod=isset($$prodx)?$$prodx:0;
    if ($prod!='0'){
        if ($i==0){
            $prodStr=$prod.":".$i;
        }
        else{
            $prodStr=$prodStr."|".$prod.":".$i;
        }
        $ct=$ct+1;
    }
}
$res=Products::setProductActivity(2, false,false , $prodStr, $ct);
if ($res==0){
    ReturnHandler::response(1);
}
else{
    ReturnHandler::response(32,null,'資料有錯誤');
}