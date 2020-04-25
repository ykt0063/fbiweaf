<?php
use report\response\ReturnHandler;
use report\tool\image;
use report\user\product;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require_once( __DIR__."/../init.inc.php" );

$tag1=true;
$tag2=true;
$tag3=true;
$tag4=true;

$success1=true;
$success2=true;
$success3=true;
$success4=true;

$obj = product::getProductType();
$data=$obj['data'];
$ct=count($data);
$tArrays=array();
for ($i=0;$i<$ct;$i++){
    $tArrays[]=$data[$i]['typeNO'];
}
$result = product::getProductList('');
$data=$result['data'];
$pArray=array();
foreach( $data as $row ){
    $pArray[]=$row['prodNO'];
}
$s =dirname(getcwd());
//$names=array();
$Product1TAG=(empty($_REQUEST['Product1TAG']))?"FALSE":$_REQUEST['Product1TAG'];
$Product2TAG=(empty($_REQUEST['Product2TAG']))?"FALSE":$_REQUEST['Product2TAG'];
$Product3TAG=(empty($_REQUEST['Product3TAG']))?"FALSE":$_REQUEST['Product3TAG'];
$Product4TAG=(empty($_REQUEST['Product4TAG']))?"FALSE":$_REQUEST['Product4TAG'];
$Product1TAG=(strtoupper($Product1TAG)=='TRUE')?true:false;
$Product2TAG=(strtoupper($Product2TAG)=='TRUE')?true:false;
$Product3TAG=(strtoupper($Product3TAG)=='TRUE')?true:false;
$Product4TAG=(strtoupper($Product4TAG)=='TRUE')?true:false;
$name1=array();
$name2=array();
$name3=array();
$name4=array();
if ($Product1TAG){
    if ( $_FILES["Product1File"]["error"][0] == UPLOAD_ERR_OK){
        $name1=$_FILES["Product1File"]["name"];
        for ($i=0;$i<sizeof($name1);$i++){
            if (file_exists($s."/uploads/" . $name1[$i])){
                unlink($s."/uploads/" . $name1[$i]);
            }
            $nameX = basename($name1[$i]);
            $uploadTag=move_uploaded_file($_FILES["Product1File"]["tmp_name"][$i],$s."/uploads/".$nameX);
            
            //$names[]=$nameX;
            $tag1=$tag1 && $uploadTag;
            $success1=true;
        }
    }
    else{
        $tag1=false;
        $success1=false;
        $msg=$msg."大圖上傳不成功\n";
    }
}
else{
    $tag1=false;
    $success1=true;
}

$msg='';
if ($tag1){
    for ($i=0;$i<sizeof($name1);$i++){
        list($width, $height) = getimagesize($s.'/uploads/'.$name1[$i]);
        if ($width>=999 && $height>=999){
            $source_image = $s.'/uploads/'.$name1[$i];
            $tArray=preg_split ("/\./", $name1[$i]);
            $cFile=$tArray[0];
            if (in_array($cFile,$pArray)){
                $cc=substr($cFile,0,2);
                $tmpPath=$s.'/assets/images/product/p1/'.$cc;
                if (in_array($cc,$tArrays)){
                    if (file_exists($tmpPath)){
                        if (!is_dir($tmpPath)){
                            $msg=$msg."大圖路徑".$cc."非目錄結構\n";
                            $success1=false;
                        }
                    }
                    else{
                        mkdir($tmpPath, 0777, true);
                    }
                    if ($success1){
                        $destination = $tmpPath.'/'.$cFile.'.png';
                        if (file_exists($destination)){
                            unlink($destination);
                        }
                        $tn_w = $width;
                        $tn_h = $height;
                        $quality = 0;
                        $wmsource=false;
                        $s1 = image::image_handler($source_image,$destination,$tn_w,$tn_h,$quality,$wmsource);
                        if (!$s1){
                            $msg=$msg."大圖".$name1[$i].'轉存檔案有問題\n';
                        }
                        $success1=$success1 && $s1;
                    }
                }
                else{
                    $msg=$msg."大圖".$name1[$i].' 對應產品目錄不存在\n';
                    $success1=false;
                }
            }
            else{
                $msg=$msg."大圖".$name1[$i].' 對應產品檔案不存在\n';
                $success1=false;
            }
        }
        else{
            $msg=$msg."大圖".$name1[$i].'檔案資料寬度需要大於999px且寬度需要大於999px\n';
            $success1=false;
        }
    }
    if ($success1){
        $msg=$msg."大圖轉檔成功\n";
    }
}

$checkP12=(empty($_REQUEST['checkP12']))?"":$_REQUEST['checkP12'];
if($checkP12=='1'){
    $name2=$name1;
}
else{
    if ($Product2TAG){
        if ($_FILES["Product2File"]["error"][0] == UPLOAD_ERR_OK){
            $name2=$_FILES["Product2File"]["name"];
            for ($i=0;$i<sizeof($name2);$i++){
                if (file_exists($s."/uploads/" . $name2[$i])){
                    unlink($s."/uploads/" . $name2[$i]);
                }
                $nameX = basename($name2[$i]);
                $uploadTag=move_uploaded_file($_FILES["Product2File"]["tmp_name"][$i],$s."/uploads/".$nameX);
                
                //$names[]=$nameX;
                $tag2=$tag2 && $uploadTag;
                $success2=true;
            }
        }
        else{
            $tag2=false;
            $success2=false;
            $msg=$msg."小圖上傳不成功\n";
        }
    }
    else{
        $tag2=false;
        $success2=true;
    }
}

if ($tag2){
    for ($i=0;$i<sizeof($name2);$i++){
        list($width, $height) = getimagesize($s.'/uploads/'.$name2[$i]);
        if ($width>=499 && $height>=499){
            $source_image = $s.'/uploads/'.$name2[$i];
            $tArray=preg_split ("/\./", $name2[$i]);
            $cFile=$tArray[0];
            if (in_array($cFile,$pArray)){
                $cc=substr($cFile,0,2);
                $tmpPath=$s.'/assets/images/product/p2/'.$cc;
                if (in_array($cc, $tArrays)){
                    if (file_exists($tmpPath)){
                        if (!is_dir($tmpPath)){
                            $msg=$msg."小圖路徑".$cc."非目錄結構\n";
                            $success2=false;
                        }
                    }
                    else{
                        mkdir($tmpPath, 0777, true);
                    }
                    if ($success2){
                        $destination = $tmpPath.'/'.$cFile.'.png';
                        if (file_exists($destination)){
                            unlink($destination);
                        }
                        $tn_w = $width;
                        $tn_h = $height;
                        $quality = 0;
                        $wmsource=false;
                        $s2 = image::image_handler($source_image,$destination,$tn_w,$tn_h,$quality,$wmsource);
                        if (!$s2){
                            $msg=$msg."小圖".$name2[$i].'轉存檔案有問題\n';
                        }
                        $success2=$success2 && $s2;
                    }
                }
                else{
                    $msg=$msg."小圖".$name2[$i].' 對應產品目錄不存在\n';
                    $success2=false;
                }
            }
            else{
                $msg=$msg."小圖".$name2[$i].' 對應產品檔案不存在\n';
                $success2=false;
            }
        }
        else{
            $msg=$msg."小圖".$name2[$i].'檔案資料寬度需要大於499px且寬度需要大於499px\n';
            $success2=false;
        }
    }
    if ($success2){
        $msg=$msg."小圖轉檔成功\n";
    }
}
if ($Product3TAG){
    if ($_FILES["Product3File"]["error"][0] == UPLOAD_ERR_OK ){
        $name3=$_FILES["Product3File"]["name"];
        for ($i=0;$i<sizeof($name3);$i++){
            if (file_exists($s."/uploads/" . $name3[$i])){
                unlink($s."/uploads/" . $name3[$i]);
            }
            $nameX = basename($name3[$i]);
            $uploadTag=move_uploaded_file($_FILES["Product3File"]["tmp_name"][$i],$s."/uploads/".$nameX);
            
            //$names[]=$nameX;
            $tag3=$tag3 && $uploadTag;
            $success3=true;
        }
    }
    else{
        $tag3=false;
        $success3=false;
        $msg=$msg."產品特性圖上傳不成功\n";
    }
}
else{
    $tag3=false;
    $success3=true;
}

//$msg='';
if ($tag3){
    for ($i=0;$i<sizeof($name3);$i++){
        list($width, $height) = getimagesize($s.'/uploads/'.$name3[$i]);
        if ($width>=999 && $height>=999){
            $source_image = $s.'/uploads/'.$name3[$i];
            $tArray=preg_split ("/\./", $name3[$i]);
            $cFile=$tArray[0];
            if (in_array($cFile,$pArray)){
                $cc=substr($cFile,0,2);
                $tmpPath=$s.'/assets/images/product/p3/'.$cc;
                if (in_array($cc,$tArrays)){
                    if (file_exists($tmpPath)){
                        if (!is_dir($tmpPath)){
                            $msg=$msg."產品特性圖路徑".$cc."非目錄結構\n";
                            $success3=false;
                        }
                    }
                    else{
                        mkdir($tmpPath, 0777, true);
                    }                    
                    if ($success3){
                        $destination = $tmpPath.'/'.$cFile.'.png';
                        if (file_exists($destination)){
                            unlink($destination);
                        }
                        $tn_w = $width;
                        $tn_h = $height;
                        $quality = 0;
                        $wmsource=false;
                        $s3 = image::image_handler($source_image,$destination,$tn_w,$tn_h,$quality,$wmsource);
                        if (!$s3){
                            $msg=$msg."產品特性圖".$name3[$i].'轉存檔案有問題\n';
                        }
                        $success3=$success3.$s3;
                    }                    
                }
                else{
                    $msg=$msg."產品特性圖".$name3[$i].' 對應產品目錄不存在\n';
                    $success3=false;
                }
            }
            else{
                $msg=$msg."產品特性圖".$name3[$i].' 對應產品檔案不存在\n';
                $success3=false;
            }
        }
        else{
            $msg=$msg."產品特性圖".$name3[$i].'檔案資料寬度需要大於999px且寬度需要大於999px\n';
            $success3=false;
        }
    }
    if ($success3){
        $msg=$msg."產品特性圖轉檔成功\n";
    }
}

if ($Product4TAG){
    if ($_FILES["Product4File"]["error"][0] == UPLOAD_ERR_OK ){
        $name4=$_FILES["Product4File"]["name"];
        for ($i=0;$i<sizeof($name4);$i++){
            if (file_exists($s."/uploads/" . $name4[$i])){
                unlink($s."/uploads/" . $name4[$i]);
            }
            $nameX = basename($name4[$i]);
            $uploadTag=move_uploaded_file($_FILES["Product4File"]["tmp_name"][$i],$s."/uploads/".$nameX);
            
            //$names[]=$nameX;
            $tag4=$tag4 && $uploadTag;
            $success4=true;
        }
    }
    else{
        $tag4=false;
        $success4=false;
        $msg=$msg."產品規格圖上傳不成功\n";
    }
}
else{
    $tag4=false;
    $success4=true;
}

//$msg='';
if ($tag4){
    for ($i=0;$i<sizeof($name4);$i++){
        list($width, $height) = getimagesize($s.'/uploads/'.$name4[$i]);
        if ($width>=500 && $height>=500){
            $source_image = $s.'/uploads/'.$name4[$i];
            $tArray=preg_split ("/\./", $name4[$i]);
            $cFile=$tArray[0];
            if (in_array($cFile,$pArray)){
                $cc=substr($cFile,0,2);
                $tmpPath=$s.'/assets/images/product/p4/'.$cc;
                if (in_array($cc,$tArrays)){
                    if (file_exists($tmpPath)){
                        if (!is_dir($tmpPath)){
                            $msg=$msg."產品特性圖路徑".$cc."非目錄結構\n";
                            $success4=false;
                        }
                    }
                    else{
                        mkdir($tmpPath, 0777, true);
                    }
                    if ($success4){
                        $destination = $tmpPath.'/'.$cFile.'.png';
                        if (file_exists($destination)){
                            unlink($destination);
                        }
                        $tn_w = $width;
                        $tn_h = $height;
                        $quality = 0;
                        $wmsource=false;
                        $s4 = image::image_handler($source_image,$destination,$tn_w,$tn_h,$quality,$wmsource);
                        if (!$s4){
                            $msg=$msg."產品規格圖".$name4[$i].'轉存檔案有問題\n';
                        }
                        $success4=$success4.$s4;
                    }
                }
                else{
                    $msg=$msg."產品規格圖".$name4[$i].' 對應產品目錄不存在\n';
                    $success4=false;
                }
            }
            else{
                $msg=$msg."產品規格圖".$name4[$i].' 對應產品檔案不存在\n';
                $success4=false;
            }
        }
        else{
            $msg=$msg."產品規格圖".$name4[$i].'檔案資料寬度需要大於500px且寬度需要大於500px\n';
            $success4=false;
        }
    }
    if ($success4){
        $msg=$msg."產品規格圖轉檔成功\n";
    }
}

if (($Product1TAG && !($tag1 && $success1))||($Product2TAG && !($tag2 && $success2))||($Product3TAG && !($tag3 && $success3))||($Product4TAG && !($tag4 && $success4))){
    ReturnHandler::response(32,null,$msg);
}
else{
   $obj=image::setProduct($name1,$name2,$name3,$name4);
   $code=$obj['code'];
    if ($code==0)
        ReturnHandler::response(1);
        else{
            $msg=$msg.'db error:'.$obj['desc'].'\n';
        }
}