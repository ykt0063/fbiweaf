<?php
/*
 *	產生驗證碼圖片的檔案
 */
$img_height = 46;  //圖片高度
$img_width = 120;   //圖片寬度
$mass = 500;       //圖片上雜點的數量，值越大，畫面越雜

$num="";           //驗證碼的數字
$num_max = 4;      //驗證碼數字的數量，目前設定4位數

for( $i=0; $i<$num_max; $i++ )//亂數產生數字
{
//     $tmp=rand(0,31);
//     $tag=0;
//     if ($tmp>15){
//         $tag=1;
//         $tmp=$tmp-16;
//     }
//     $tmps=dechex($tmp);
//     if ($tag==1){
//         $tmps=strtoupper($tmps);
//     }
    $tmps=rand(0,10);
    if ($tmps==10){
        $tmps=9;
    }
    $num .= $tmps;
}

//基本上使用session儲存驗證碼
session_start();
$_SESSION["checkNum"] = $num;  // 將產生的驗證碼寫入到session

// 創造圖片，定義圖形和文字顏色
Header("Content-type: image/PNG");//這句是最重要的一句！
srand((double)microtime()*1000000);
$im = imagecreate($img_width,$img_height);
$black = ImageColorAllocate($im, 0,0,0);// (0,0,0)文字為黑色
$gray = ImageColorAllocate($im, 200,200,200); //(200,200,200)背景是灰色
imagefill($im,0,0,$gray);

// 隨機給予兩條虛線，起干擾作用
$style = array($black, $black, $black, $black, $black, $gray, $gray, $gray, $gray, $gray);
imagesetstyle($im, $style);
$y1=rand(0,$img_height);
$y2=rand(0,$img_height);
$y3=rand(0,$img_height);
$y4=rand(0,$img_height);
$y5=rand(0,$img_height);
$y6=rand(0,$img_height);
$y7=rand(0,$img_height);
$y8=rand(0,$img_height);
imageline($im, 0, $y1, $img_width, $y3, IMG_COLOR_STYLED);
imageline($im, 0, $y2, $img_width, $y4, IMG_COLOR_STYLED);
imageline($im, 0, $y5, $img_width, $y7, IMG_COLOR_STYLED);
imageline($im, 0, $y6, $img_width, $y8, IMG_COLOR_STYLED);

// 在圖形產上黑點，起干擾作用;
for( $i=0; $i<$mass; $i++ )
{
    imagesetpixel($im, rand(0,$img_width), rand(0,$img_height), $black);
}

// 將數字隨機顯示在圖形上,文字的位置都按一定波動範圍隨機生成
$strx=rand(3,20);
$font = '/usr/share/fonts/truetype/Sarai/Sarai.ttf';
for( $i=0; $i<$num_max; $i++ )
{
    $strpos=rand(24,33);
    //imagestring($im,12,$strx,$strpos, substr($num,$i,1), $black);
    imagettftext($im, 24, 0, $strx, $strpos, $black, $font, substr($num,$i,1));
    $strx+=rand(20,25);
}
ImagePNG($im);
ImageDestroy($im);
?>