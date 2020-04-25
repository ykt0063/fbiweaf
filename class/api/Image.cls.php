<?php
namespace api\work;

use core\main\Main;
use core\response\cReturnHandler;

class Image{
    public function __construct(){
        
    }
    public static function DisableBanner($obj){
        $banner=$obj['banner'];
        $sqlStr="";
        for($i=0;$i<sizeof($banner);$i++){
            $sqlStr=$sqlStr."call disableBanner('$banner[$i]');\n";
        }
        $code=0;
        $data=array();
        $result = Main::$mysql->sql_multi_query($sqlStr);
        $code=1;
        $data=array();
        if($result){
            foreach($result as $row){
                $data[]=$row;
            }
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$data;
        return cReturnHandler::responseObj(1,  $obj);
    }
    public static function setProductImage($obj){
        $name1=$obj['p1'];
        $name2=$obj['p2'];
        $name3=$obj['p3'];
        $name4=$obj['p4'];
        $sqlStr="";
        $tag=false;
        $data=array();
        if ($name1){    
            for($i=0;$i<sizeof($name1);$i++){
                $sqlStr=$sqlStr."call fbi.setProductImage('$name1[$i]',3);\n";
            }
            $tag=$tag || true;
        }
        if ($name2){
            for($i=0;$i<sizeof($name2);$i++){
                $sqlStr=$sqlStr."call fbi.setProductImage('$name2[$i]',4);\n";
            }
            $tag=$tag || true;
        }
        if ($name3){
            for($i=0;$i<sizeof($name3);$i++){
                $sqlStr=$sqlStr."call fbi.setProductImage('$name3[$i]',5);\n";
            }
            $tag=$tag || true;
        }
        if ($name4){
            for($i=0;$i<sizeof($name4);$i++){
                $sqlStr=$sqlStr."call fbi.setProductImage('$name4[$i]',6);\n";
            }
            $tag=$tag || true;
        }
        $code=0;
        $data=array();
        if ($tag)
        $result = Main::$mysql->sql_multi_query($sqlStr);
        $code=1;        
        if($result){
            foreach($result as $row){
                $data[]=$row;
            }
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$data;
        return cReturnHandler::responseObj(1,  $obj);
    }
    public static function checkCategoryImage($obj){
      $cID=$obj['cID'];
      $sqlStr="call categoryImageCheck('$cID')";
      $res = Main::$mysql->sql_query($sqlStr);
      $code=0;
      $fName="";
      $data=array();
      if($res){
          foreach($res as $row){
              $code=$row['res'];
              $fName = $row['fileName'];
          }
      }
      $obj=array();
      $obj['code']=$code;
      $obj['fName']=$fName;
      return cReturnHandler::responseObj(1,  $obj);   
    }
    public static function getBanner(){
        $sqlStr="call bannerGet()";
        $res = Main::$mysql->sql_query($sqlStr);
        $code=0;
        $data=array();
        if(is_object($res)&&(Main::$mysql->sql_num_rows($res)>=0)){
            foreach($res as $key=>$row){
                $data[]=$row['fileName'];
            }
            $code=1;
        }    
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$data;
        return cReturnHandler::responseObj(1,  $obj);        
    }
    
    public static function setCategory($object){
        $name=$object['name'];
        $sqlStr="call categoryClear();\n";
        for ($i=0;$i<sizeof($name);$i++){
            $sqlStr=$sqlStr."call categoryAdd('$name[$i]');\n";
        }
        //        $sqlStr="call getEXLists('$account','$bdate','$edate')";
        //echo "<br>".$sqlStr."<br>";
        $result = Main::$mysql->sql_multi_query($sqlStr);
        $code=1;
        $data=array();
        if($result){
            foreach($result as $row){
                $data[]=$row;
            }
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$data;
        return cReturnHandler::responseObj(1,  $obj);
    }
    public static function setBanner($object){
        $name=$object['name'];
        $sqlStr="call bannerClear();\n";
        for ($i=0;$i<sizeof($name);$i++){
            $sqlStr=$sqlStr."call bannerAdd('$name[$i]');\n";
        }
//        $sqlStr="call getEXLists('$account','$bdate','$edate')";
        //echo "<br>".$sqlStr."<br>";
        $result = Main::$mysql->sql_multi_query($sqlStr);
        $code=1;
        $data=array();
        if($result){
            foreach($result as $row){
                $data[]=$row;
            }
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$data;
        return cReturnHandler::responseObj(1,  $obj);
    }
}