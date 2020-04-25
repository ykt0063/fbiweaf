<?php
use report\response\ReturnHandler;
use report\tool\image;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require_once( __DIR__."/../init.inc.php" );
$len=sizeof($banner);
if ($len>0){
    $obj=image::disableBanner($banner);
}
ReturnHandler::response(1);