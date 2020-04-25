<?php
namespace report\order;
use report\base\ApiHandler;
class Products{
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
    public static function SetOrder($mbno,$totalPrice,$prodInfo,$prodNumber,$objStr,$payMethod,$transFee,$payEP,$transCode){
        $retObj=array();
        $object = array();
        $object['MBNO']=$mbno;
        $object['TotalPrice']=$totalPrice;
        $object['ProdInfo']=$prodInfo;
        $object['ProdNumber']=$prodNumber;
        $object['Term']=0;
        $object['payMethod']=$payMethod;
        $object['objStr']=$objStr;
        $object['transFee']=$transFee;
        $object['payEP']=$payEP;
        $object['transCode']=$transCode;
        $result = ApiHandler::callApi('setOrder', $object);
        if ($result['code']==0){
            //         $listA = $result['data'];
            $retObj=$result['data'];
        }
        return $retObj;
    }
    public static function SetOfficialOrder($orderObj){
        $result = ApiHandler::callApi('setOfficialOrder', $orderObj);
        $retObj=1;
        if ($result['code']==0){
            //         $listA = $result['data'];
            $retObj=$result['code'];
            $data=$result['data'];
            foreach($data AS $key => $row){
                $lid = $row['LID'];
            }
        }
        return $retObj;
    }
    public static function SetResponse($web,$supplierTradeNo,$tradeNo,$price,$approveCode,$cardNo,$errCode,$errMsg,$invoiceNo,$postData,$transCode,$obj){
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
        $object['postData']=$postData;
        $object['transCode']=$transCode;
        $object['obj']=$obj;
        $result = ApiHandler::callApi('setDBResponse', $object);
        if ($result['code']==0){
            //         $listA = $result['data'];
            $retObj=$result['data'];
        }
        return $retObj;
    }
    public static function SunShipReceiveData($buysafeno,$web,$Td,$MN,$note1,$note2,$SendType,$CargoNo,$StoreID,$StoreName,$StoreType,$StoreMsg){
        $retObj=array();
        $object = array();
        $object['web']=$web;
        $object['Td']=$Td;
        $object['buysafeno']=$buysafeno;
        $object['MN']=$MN;
        $object['note1']=$note1;
        $object['note2']=$note2;
//        $object['errCode']=$errCode;
        $object['SendType']=$SendType;
        $object['CargoNo']=$CargoNo;
        $object['StoreID']=$StoreID;
        $object['StoreName']=$StoreName;
        $object['StoreType']=$StoreType;
        $object['StoreMsg']=$StoreMsg;
        $result = ApiHandler::callApi('SunShipReceiveData', $object);
        if ($result['code']==1){
            //         $listA = $result['data'];
            $retObj='1';
        }
        return $retObj;
    }
    public static function SunShipPaidData($buysafeno,$web,$Td,$MN,$errCode,$errmsg,$InvoiceNo,$CargoNo){
        $retObj='0';
        $object = array();
        $object['web']=$web;
        $object['Td']=$Td;
        $object['buysafeno']=$buysafeno;
        $object['MN']=$MN;
        $object['errCode']=$errCode;
        $object['errmsg']=$errmsg;
        $object['InvoiceNo']=$InvoiceNo;
        $object['CargoNo']=$CargoNo;
        $result = ApiHandler::callApi('SunShipPaidData', $object);
        if ($result['code']==1){
            //         $listA = $result['data'];
            $retObj='1';
        }
        return $retObj;
    }
    public static function SunshipLogisticsStatusUpdate($iTID,$iStoreType,$iSToreMsg){
        $retObj='0';
        $object = array();
        $object['iSToreMsg']=$iSToreMsg;
        $object['iStoreType']=$iStoreType;
        $object['iTID']=$iTID;
        $result = ApiHandler::callApi('SunshipLogisticsStatusUpdate', $object);
        if ($result['code']==1){
            //         $listA = $result['data'];
            $retObj='1';
        }
        return $retObj;
    }
}