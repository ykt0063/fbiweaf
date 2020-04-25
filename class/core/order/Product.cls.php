<?php
namespace report\order;
use report\base\ApiHandler;
class Product{
    public static function GetList($categoryID=''){//for  category
        $retObj=array();
        $kind=1;
        $object = array();
        if ($categoryID!=''){
            $kind=2;
            $object = array();
            $object['category']=$categoryID;
        }
        $object['kind']=$kind;
        $result = ApiHandler::callApi('showProduct', $object);
        if ($result['code']==0){
            //         $listA = $result['data'];
            $retObj=$result['data'];
        }
        return $retObj;
    }
    public static function GetList1($categoryID=''){//for category
        $retObj=array();
        $kind=1;
        $object = array();
        if ($categoryID!=''){
            $kind=2;
            $object = array();
            $object['category']=$categoryID;
        }
        $object['kind']=$kind;
        $result = ApiHandler::callApi('showProduct1', $object);
        if ($result['code']==0){
            //         $listA = $result['data'];
            $retObj=$result['data'];
        }
        return $retObj;
    }
    public static function GetList2($prodID=''){//for product list
        $retObj=array();
        $kind=1;
        $object = array();
        if ($prodID!=''){
            $kind=2;
            $object = array();
            $object['prodID']=$prodID;
        }
        $object['kind']=$kind;
        $result = ApiHandler::callApi('showProduct2', $object);
        if ($result['code']==0){
            //         $listA = $result['data'];
            $retObj=$result['data'];
        }
        return $retObj;
    }
    public static function SetList1($categoryID,$array){
        $object=array();
        $object['categoryID']=$categoryID;
        $object['data']=$array;
        $result = ApiHandler::callApi('setCategory1', $object);
        
        $code=1;
        if ($result['code']==0){
            //         $listA = $result['data'];
            $code=0;
        }
        return $code;
    }
    public static function GetProductDetail($prodNo){
        $retObj=array();
        $object = array();
        $object['prodNo']=$prodNo;
        $result = ApiHandler::callApi('getProductDetailData', $object);
        if ($result['code']==1){
            //         $listA = $result['data'];
            $retObj=$result['data'];
        }
        return $retObj;
    }
    public static function SetProductDetail($object){
        $spec=$object['spec'];
        $specArray = explode("\r\n", $spec);
        if (count($specArray)==1){
            $specArray = explode("\n", $spec);
        }
        $object['specNumber']=0;
        if (count($specArray)>0){
            $ct=count($specArray);
            $spec=$specArray[0];
            for ($i=1;$i<$ct;$i++){
                $spec=$spec."|".$specArray[$i];
            }
            $object['spec']=$spec;
            $object['specNumber']=$ct;
        }
        $result = ApiHandler::callApi('setProductDetail', $object);
        $retCode=1;
        if ($result['code']==0){
            //         $listA = $result['data'];
            $retCode=0;
        }
        return $retCode;
    }
    public static function setProductActivity($tag,$begin,$end,$data,$dNumber){
        $obj=array(
            'tag'=>$tag,//1:limti_time,2:hot,3:spec
            'begin'=>$begin,
            'end'=>$end,
            'data'=>$data,
            'dNumber'=>$dNumber
        );
        $result = ApiHandler::callApi('setProductActivity', $obj);
        $retCode=1;
        if ($result['code']==0){
            //         $listA = $result['data'];
            $retCode=0;
        }
        return $retCode;
    }
    public static function getProductActivity($tag){
        $obj=array('tag'=>$tag);
        $result = ApiHandler::callApi('getProductActivity', $obj);
        $retCode=1;
        $data=null;
        if ($result['code']==0){
            $data = $result['data'];
            $retCode=0;
        }
        return array('code'=>$retCode,'data'=>$data);
    }
    public static function getgetProductActivityLimitTime(){
        $obj=array();
        $result = ApiHandler::callApi('getProductActivityLimitTime',$obj);
        $retCode=1;
        $data=null;
        if ($result['code']==0){
            $data = $result['data'];
            $retCode=0;
        }
        return array('code'=>$retCode,'data'=>$data);
    }
    public static function SetOrder($mbno,$totalPrice,$prodInfo,$prodNumber,$objStr,$payMethod,$term=''){
        $retObj=array();
        $object = array();
        $object['MBNO']=$mbno;
        $object['TotalPrice']=$totalPrice;
        $object['ProdInfo']=$prodInfo;
        $object['ProdNumber']=$prodNumber;
        $object['Term']=$term;
        $object['payMethod']=$payMethod;
        $object['objStr']=$objStr;
        $result = ApiHandler::callApi('setOrder', $object);
        if ($result['code']==0){
            //         $listA = $result['data'];
            $retObj=$result['data'];
        }
        return $retObj;
    }
    public static function SetResponse($web,$supplierTradeNo,$tradeNo,$price,$approveCode,$cardNo,$errCode,$errMsg,$invoiceNo){
        $retObj=array();
        $object = array();
        $object['web']=$web;
        $object['supplierTradeNo']=$supplierTradeNo;
        $object['tradeNo']=$tradeNo;
        $object['price']=$price;
        $object['approveCode']=$approveCode;
        $object['cardNo']=$cardNo;
        $object['errCode']=$errCode;
        $object['errMsg']=$errMsg;
        $object['invoiceNo']=$invoiceNo;
	$obj=array('buysafeno'=>"",'Td'=>"",'MN'=>"",'Name'=>"",'note1'=>"",'note2'=>"",'ApproveCode'=>"",'Card_NO'=>"");
        $object['obj']=$obj;
        $result = ApiHandler::callApi('setDBResponse', $object);
        if ($result['code']==0){
            //         $listA = $result['data'];
            $retObj=$result['data'];
        }
        return $retObj;
    }
}
