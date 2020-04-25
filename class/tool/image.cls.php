<?php
namespace report\tool;

use report\base\ApiHandler;
use report\base\Json;

class image{
    public static function disableBanner($banner){
        $query=array('banner'=>$banner);
        $result = ApiHandler::callApi('DisableBanner', $query);
        if(!isset($result['code']) || $result['code'] != 1){
            $code=-1;
            $desc = isset($result['desc']) ? $result['desc'] : '';
            $msg = $desc;
            //                 $msg =ReturnHandler::responseObj(999, null, $desc);
        }
        else{
            $code=0;
            $msg='';
        }
        $retObj = array(
            'code' => $code,
            'desc' => $msg,
        );
        return $retObj;
    }
    public static function setProduct($name1,$name2,$name3,$name4){
        $query=array('p1'=>$name1,'p2'=>$name2,'p3'=>$name3,'p4'=>$name4);
        $result = ApiHandler::callApi('setProductImage', $query);
        if(!isset($result['code']) || $result['code'] != 1){
            $code=-1;
            $desc = isset($result['desc']) ? $result['desc'] : '';
            $msg = $desc;
            //                 $msg =ReturnHandler::responseObj(999, null, $desc);
        }
        else{
            $code=0;
            $msg='';
        }
        $retObj = array(
            'code' => $code,
            'desc' => $msg,
        );
        return $retObj;
    }
    public static function checkCategoryImage($CategoryID){
        $query=array('cID'=>$CategoryID);
        $result = ApiHandler::callApi('checkCategoryImage', $query);
        return $result;
    }
    public static function getBanner(){
        $query = array();
        $result = ApiHandler::callApi('getBanner', $query);
        $obj=array();
        if(!isset($result['code']) || $result['code'] != 1){
            //nothing to do
        }
        else{
            $data=$result['data'];
            $words=array('banner1','banner2','banner3');
            for ($i=0;$i<sizeof($data);$i++){
                $tArray=preg_split ("/\./", $data[$i]);
                $tX=$tArray[0];
                if (in_array($tX,$words)){
                    $tX='AA001';
                }
                //$obj[]=array($data[$i],$tX);
                $obj[]=array($tX.".png",$tX);
            }
        }
        return $obj;
    }
    public static function setCategory($name){
        $query = array(
            'name' => $name,
        );
        $result = ApiHandler::callApi('setCategory', $query);
        if(!isset($result['code']) || $result['code'] != 1){
            $code=-1;
            $desc = isset($result['desc']) ? $result['desc'] : '';
            $msg = $desc;
            //                 $msg =ReturnHandler::responseObj(999, null, $desc);
        }
        else{
            $code=0;
            $msg='';
        }
        $retObj = array(
            'code' => $code,
            'desc' => $msg,
        );
        return $retObj;
        
    }
    public static function setBanner($name){
        $query = array(
            'name' => $name,
        );
        $result = ApiHandler::callApi('setBanner', $query);        
        if(!isset($result['code']) || $result['code'] != 1){
            $code=-1;
            $desc = isset($result['desc']) ? $result['desc'] : '';
            $msg = $desc;
            //                 $msg =ReturnHandler::responseObj(999, null, $desc);
        }
        else{
            $code=0;
            $msg='';
        }
        $retObj = array(
            'code' => $code,
            'desc' => $msg,
        );
        return $retObj;
    }
    public static function getSImage($fname){
        if (file_exists($fname)){
            unlink($fname);
        }
        $filename = WEB_ASSET_URL.'images/'.$fname;
        if (exif_imagetype($filename) == IMAGETYPE_GIF) {
            header('Content-Type: image/gif');
            $source = imagecreatefromgif($filename);
        }
        else if (exif_imagetype($filename) == IMAGETYPE_PNG) {
            header('Content-Type: image/png');
            $source = imagecreatefrompng($filename);
        }
        else{
            header('Content-Type: image/jpeg');
            $source = imagecreatefromjpeg($filename);
        }
//         $percent = 0.5;
        
        // Content type
        
        // Get new sizes
        list($width, $height) = getimagesize($filename);
//        $newwidth = $width * $percent;
//         $newheight = $height * $percent;
        $newwidth = 200;
        $newheight = 200;
        
        // Load
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        
        
        // Resize
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        
        // Output
//         ob_start();
        imagejpeg($thumb,$fname);
//         $image=ob_get_contents();
//         ob_end_clean();
//        $imgData="<img src='".WEB_SITE_URL.$fname."'/>";
//        imagedestroy($image);
        imagedestroy($thumb);
        header('Content-Type: text/html');
//        return $imgData;
    }
    
    //banner width: 993 px, height: 497px
    public static function image_handler($source_image,$destination,$tn_w = 100,$tn_h = 100,$quality = 80,$wmsource = false){
        // The getimagesize functions provides an "imagetype" string contstant, which can be passed to the image_type_to_mime_type function for the corresponding mime type
        $info = getimagesize($source_image);
        $imgtype = image_type_to_mime_type($info[2]);
        // Then the mime type can be used to call the correct function to generate an image resource from the provided image
        switch ($imgtype) {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($source_image);
                break;
            case 'image/gif':
                $source = imagecreatefromgif($source_image);
                break;
            case 'image/png':
                $source = imagecreatefrompng($source_image);
                break;
            default:
                die('Invalid image type.');
        }
        // Now, we can determine the dimensions of the provided image, and calculate the width/height ratio
        $src_w = imagesx($source);
        $src_h = imagesy($source);
        $src_ratio = $src_w/$src_h;
        // Now we can use the power of math to determine whether the image needs to be cropped to fit the new dimensions, and if so then whether it should be cropped vertically or horizontally. We're just going to crop from the center to keep this simple.
        if ($tn_w/$tn_h > $src_ratio) {
            $new_h = $tn_w/$src_ratio;
            $new_w = $tn_w;
        } else {
            $new_w = $tn_h*$src_ratio;
            $new_h = $tn_h;
        }
        $x_mid = $new_w/2;
        $y_mid = $new_h/2;
        // Now actually apply the crop and resize!
        $newpic = imagecreatetruecolor(round($new_w), round($new_h));
        imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
        $final = imagecreatetruecolor($tn_w, $tn_h);
        imagecopyresampled($final, $newpic, 0, 0, ($x_mid-($tn_w/2)), ($y_mid-($tn_h/2)), $tn_w, $tn_h, $tn_w, $tn_h);
        // If a watermark source file is specified, get the information about the watermark as well. This is the same thing we did above for the source image.
        if($wmsource) {
            $info = getimagesize($wmsource);
            $imgtype = image_type_to_mime_type($info[2]);
            switch ($imgtype) {
                case 'image/jpeg':
                    $watermark = imagecreatefromjpeg($wmsource);
                    break;
                case 'image/gif':
                    $watermark = imagecreatefromgif($wmsource);
                    break;
                case 'image/png':
                    $watermark = imagecreatefrompng($wmsource);
                    break;
                default:
                    die('Invalid watermark type.');
            }
            // Determine the size of the watermark, because we're going to specify the placement from the top left corner of the watermark image, so the width and height of the watermark matter.
            $wm_w = imagesx($watermark);
            $wm_h = imagesy($watermark);
            // Now, figure out the values to place the watermark in the bottom right hand corner. You could set one or both of the variables to "0" to watermark the opposite corners, or do your own math to put it somewhere else.
            $wm_x = $tn_w - $wm_w;
            $wm_y = $tn_h - $wm_h;
            // Copy the watermark onto the original image
            // The last 4 arguments just mean to copy the entire watermark
            imagecopy($final, $watermark, $wm_x, $wm_y, 0, 0, $tn_w, $tn_h);
        }
        // Ok, save the output as a jpeg, to the specified destination path at the desired quality.
        // You could use imagepng or imagegif here if you wanted to output those file types instead.
//         if(Imagejpeg($final,$destination,$quality)) {
           if(Imagepng($final,$destination)) {
            return true;
        }
        // If something went wrong
        return false;
    }
}