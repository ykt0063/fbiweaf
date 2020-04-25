<?php
use report\response\ReturnHandler;
use report\tool\image;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require_once( __DIR__."/../init.inc.php" );

$tag=true;
$s =dirname(getcwd());
//$names=array();
if ($_FILES["banner"]["error"][0] == UPLOAD_ERR_OK){
    $name=$_FILES["banner"]["name"];
    for ($i=0;$i<sizeof($name);$i++){
        if (file_exists($s."/uploads/" . $name[$i])){
            unlink($s."/uploads/" . $name[$i]);
        }
        $nameX = basename($name[$i]);
        $uploadTag=move_uploaded_file($_FILES["banner"]["tmp_name"][$i],$s."/uploads/".$nameX);
        
        //$names[]=$nameX;
        $tag=$tag && $uploadTag;
    }
}
else{
    $tag=false;
}
$success=false;
$msg='';
if ($tag){
    for ($i=0;$i<sizeof($name);$i++){
        list($width, $height) = getimagesize($s.'/uploads/'.$name[$i]);
        if ($width>=993 && $height>=497){
            $source_image = $s.'/uploads/'.$name[$i];
            $tArray=preg_split ("/\./", $name[$i]); 
            //specify the output path in your file system and the image size/quality
            $destination = $s.'/assets/images/main/banner/'.$tArray[0].'.png';
            if (file_exists($destination)){
                unlink($destination);
            }
            $tn_w = $width;
            $tn_h = $height;
            $quality = 0;
            $wmsource=false;
            $success = image::image_handler($source_image,$destination,$tn_w,$tn_h,$quality,$wmsource);
            if (!$success){
                $msg=$msg.$name[$i].'轉存檔案有問題\n';
            }
        }
        else{
            $msg=$msg.$name[$i].'檔案資料寬度需要大於993px且寬度需要大於497px\n';
        }
        
    }
}
if (!$tag||!$success){
    ReturnHandler::response(32,null,$msg);
}
else{
    $obj=image::setBanner($name);
    $code=$obj['code'];
    if ($code==0)
        ReturnHandler::response(1);
    else{
        $msg=$msg.'db error:'.$obj['desc'].'\n';        
    }
}