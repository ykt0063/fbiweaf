<?php
namespace report\user;

use report\base\ApiHandler;

class product{
    public static function getAllPic(){
        $query = array();
        $result = ApiHandler::callApi('getAllPic', $query);
        $data=array();
        $tag1=false;
        $tag2=false;
        $tag3=false;
        $tag4=false;
        if ($result['code']==1){
            $data1=$result['data'];
            $data2=$data1[0];
            for ($i=0;$i<sizeof($data2);$i++){
                $row=$data2[$i];
                if ($row[0]==3){
                    $data[0]['filename'][]=$row[1];//大圖
                    $tag1=true;
                }
                elseif($row[0]==4){
                    $data[1]['filename'][]=$row[1];//小圖
                    $tag2=true;
                }
                elseif($row[0]==5){
                    $data[2]['filename'][]=$row[1];//特性圖
                    $tag3=true;
                }
                elseif($row[0]==6){
                    $data[3]['filename'][]=$row[1];//規格圖
                    $tag4=true;
                }
            }
            if (!$tag1){
                $data[0]['filename']=array();
            }
            if (!$tag2){
                $data[1]['filename']=array();
            }
            if (!$tag3){
                $data[2]['filename']=array();
            }
            if (!$tag4){
                $data[3]['filename']=array();
            }
        }
        return $data;
    }
    public static function getProductType(){
        $query = array();
        $result = ApiHandler::callApi('getProductType', $query);
        if ($result['code']==0){
            $result['data']=array();
        }
        return $result;
    }
    public static function getProductTypes(){//product_type, prod_type_name and pic
        $query = array();
        $result = ApiHandler::callApi('getProductTypes', $query);
        if ($result['code']==0){
            $result['data']=array();
        }
        return $result;
    }
    public static function getProductList($category){
        $query = array('category'=>$category);
        $result = ApiHandler::callApi('getProductList', $query);
        if ($result['code']==0){
            $result['data']=array();
        }
        return $result;
    }
    public static function getProductListA($category){
        $query = array('category'=>$category);
        $result = ApiHandler::callApi('getProductList', $query);
        if ($result['code']==0){
            $result['data']=array();
        }
        $data1=$result['data'];
        $data=array();
        for ($i=0;$i<sizeof($data1);$i++){
            $data[]=$data1[$i]['prodNO'];
        }
        return $data;
    }
    public static function getProductionDetail($prodNO){
        $query=array('prodNO'=>$prodNO);
        $result = ApiHandler::callApi('getProductDetail', $query);
        if ($result['code']==0){
            $result['data']=array();
        }
        return $result;
    }
    public static function getProductImagePaths($type_no,$pic){
        if (strlen($pic)==0){
            $path='';
        }
        else{
            $path=WEB_ASSET_URL.'images/product/'.$type_no.'/'.$pic;
        }
        return $path;
    }
    public static function getProductImagePath($prodNO){
        $prodPic = Session::get('prodPic');
        $tmpName=$prodNO.'.jpg';
        $subDir=substr($prodNO,0,2);
        if (in_array($tmpName ,$prodPic[0]['filename']) ){
            $path=WEB_ASSET_URL.'images/product/p1/'.$subDir.'/'.$prodNO.'.png';
        }
        else{
            $path=product::getProductImagePath1($prodNO);
        }
        return $path;
    }
    public static function getProductImagePath1($prodNO){
        $path=WEB_ASSET_URL.'images/main/limit2.png';;
        switch ($prodNO){
            case 'AA001':
                $path=WEB_ASSET_URL.'images/product/AA/AA001.jpg';
                break;
            case 'AA002':
                $path=WEB_ASSET_URL.'images/product/AA/AA002.jpg';
                break;
            case 'AA003':
                $path=WEB_ASSET_URL.'images/product/AA/AA003.jpg';
                break;
            case 'AA004':
                $path=WEB_ASSET_URL.'images/product/AA/AA004.jpg';
                break;
            case 'AA005':
                $path=WEB_ASSET_URL.'images/product/AA/AA005.jpg';
                break;
            case 'AA006':
                $path=WEB_ASSET_URL.'images/product/AA/AA006.jpg';
                break;
            case 'AA009':
                $path=WEB_ASSET_URL.'images/product/AA/AA009.jpg';
                break;
            case 'AA010':
                $path=WEB_ASSET_URL.'images/product/AA/AA010.jpg';
                break;
            case 'CA001':
                $path=WEB_ASSET_URL.'images/product/CA/CA001.jpg';
                break;
            case 'CA003':
            case 'CA005':
                $path=WEB_ASSET_URL.'images/product/CA/CA003 & CA005.jpg';
                break;
            case 'CA004':
            case 'CA006':
            case 'CA007':
                $path=WEB_ASSET_URL.'images/product/CA/CA004, CA006,CA007.jpg';
                break;
            case 'CB001':
                $path=WEB_ASSET_URL.'images/product/CB/CB001.jpg';
                break;
            case 'CB002':
                $path=WEB_ASSET_URL.'images/product/CB/CB002.jpg';
                break;
            case 'CB003':
                $path=WEB_ASSET_URL.'images/product/CB/CB003.jpg';
                break;
            case 'CB004':
                $path=WEB_ASSET_URL.'images/product/CB/CB004.jpg';
                break;
            case 'CB005':
                $path=WEB_ASSET_URL.'images/product/CB/CB005.jpg';
                break;
            case 'CB006':
                $path=WEB_ASSET_URL.'images/product/CB/CB006.jpg';
                break;
            case 'FA001':
                $path=WEB_ASSET_URL.'images/product/FA/FA001.jpg';
                break;
            case 'FA002':
                $path=WEB_ASSET_URL.'images/product/FA/FA002.jpg';
                break;
            case 'FA003':
                $path=WEB_ASSET_URL.'images/product/FA/FA003.jpg';
                break;
            case 'WA001':
            case 'WA002':
            case 'WA003':
            case 'WA004':
            case 'WA005':
            case 'WA006':
            case 'WA007':
            case 'WA008':
            case 'WA009':
            case 'WA010':
            case 'WA011':
            case 'WA012':
            case 'WA013':
            case 'WA014':
            case 'WA015':
            case 'WA016':
            case 'WA017':
            case 'WA018':
            case 'WA019':
            case 'WA020':
            case 'WA021':
            case 'WA022':
            case 'WA023':
            case 'WA024':
            case 'WA025':
            case 'WA026':
            case 'WA027':
            case 'WA028':
            case 'WA029':
            case 'WA030':
            case 'WA031':
            case 'WA032':
                $path=WEB_ASSET_URL.'images/product/WA/WA001-WA032.jpg';
                break;
            case 'WB001':
            case 'WB002':
            case 'WB003':
            case 'WB004':
            case 'WB005':
            case 'WB006':
            case 'WB007':
            case 'WB008':
            case 'WB009':
            case 'WB010':
            case 'WB011':
            case 'WB012':
            case 'WB013':
            case 'WB014':
            case 'WB015':
            case 'WB016':
            case 'WB017':
            case 'WB018':
            case 'WB019':
            case 'WB020':
            case 'WB021':
            case 'WB022':
            case 'WB023':
            case 'WB024':
            case 'WB025':
            case 'WB026':
            case 'WB027':
            case 'WB028':
            case 'WB029':
            case 'WB030':
            case 'WB031':
            case 'WB032':
                $path=WEB_ASSET_URL.'images/product/WB/WB001-WB032.jpg';
                break;
            case 'WD001':
                $path=WEB_ASSET_URL.'images/product/WD/WD001.jpg';
                break;
            case 'WD002':
                $path=WEB_ASSET_URL.'images/product/WD/WD002.jpg';
                break;
            case 'WW002':
                $path=WEB_ASSET_URL.'images/product/WW/WW002.jpg';
                break;
            case 'WW003':
                $path=WEB_ASSET_URL.'images/product/WW/WW003-正面.jpg';
                break;
            case 'WW004':
                $path=WEB_ASSET_URL.'images/product/WW/WW004-正面.jpg';
                break;
            case 'WW005':
                $path=WEB_ASSET_URL.'images/product/WW/WW005-正面.jpg';
                break;
            case 'WW006':
                $path=WEB_ASSET_URL.'images/product/WW/WW006-正面.jpg';
                break;
            case 'WW007':
                $path=WEB_ASSET_URL.'images/product/WW/WW007-正面.jpg';
                break;
            case 'WW008':
                $path=WEB_ASSET_URL.'images/product/WW/WW008-正面.jpg';
                break;
            case 'WW009':
                $path=WEB_ASSET_URL.'images/product/WW/WW009-正面.jpg';
                break;
            case 'WW010':
                $path=WEB_ASSET_URL.'images/product/WW/WW010-正面.jpg';
                break;
        }
        return $path;
    }
    
}
