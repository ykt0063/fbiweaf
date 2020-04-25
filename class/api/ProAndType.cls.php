<?php
namespace api\product;

use core\main\Main;

class ProAndType {
    public function __construct(){   
    }
    public static function getAllPic($object){
        $sqlStr="call getAllPic()";
        $result = Main::$mysql->sql_multi_query($sqlStr);
        $retObj = array();
        $data= array();
        $code=0;
        if($result){
            $data=array();
            foreach($result as $key=>$row){
                $data[]=$row;
            }
            $retObj['data']=$data;
            $code=1;
        }
        $retObj['code']=$code;
        return $retObj;
    }
    public static function getProductDetailData($object){
        $prodNO=$object['prodNo'];
        $sqlStr="call getProductDetail('".$prodNO."')";
        $result = Main::$mysql->sql_query($sqlStr);
        $code=0;
        $data=array();
        if( $result ){
            $row = Main::$mysql->sql_fetch_array($result);
            //$res = $row['res'];
            $data=array(
                'PROD_NO'=>$row['PROD_NO'],
                'PROD_NAME'=>$row['PROD_NAME'],
                'SUG_PRICE'=>$row['SUG_PRICE'],
                'COMP_PRICE'=>$row['COMP_PRICE'],
                'PROD_UNIT'=>$row['PROD_UNIT'],
                'PV'=>$row['PV'],
                'PS'=>$row['PS'],
                'POINTS'=>$row['POINTS'],
                'MB_PRICE'=>$row['MB_PRICE'],
                'pic'=>$row['pic'],//小圖
                'pic2'=>$row['pic2'],//大圖
                'COST'=>$row['COST'],
                'chk'=>$row['chk'],
                'BARCODE'=>$row['BARCODE'],
                'EXCH_POINTS'=>$row['EXCH_POINTS'],
            );
            $code=1;
        }
        $retObj['code']=$code;
        $retObj['data']=$data;
        //return cReturnHandler::responseObj(1,  $retObj);
        return $retObj;
    }
    
    public static function getProductType($object){
        $sqlStr="call getProductType()";
        $result = Main::$mysql->sql_query($sqlStr);
        $retObj=array();
        $code=-1;
        $data=array();
        if( $result ){
            while($row = Main::$mysql->sql_fetch_array($result)){
                $row1=array();
                foreach ($row as $key => $value) {
                    if ($key=='typeNO'){
                        $row1['typeNO']=$value;
                    }
                    else{
                        $row1['typeName']=$value;
                    }
                }
//                 $row1=array('typeNO'=>$typeNO,'typeName'=>$typeName);
                $data[]=$row1;
            }
            $code=1;
        }
        $retObj['code']=$code;
        $retObj['data']=$data;
        //return cReturnHandler::responseObj(1,  $retObj);
        return $retObj;
    }
    public static function getProductTypes($object){
        $sqlStr="call getProductTypes()";
        $result = Main::$mysql->sql_query($sqlStr);
        $retObj=array();
        $code=-1;
        $data=array();
        if( $result ){
            while($row = Main::$mysql->sql_fetch_array($result)){
                $row1=array();
                foreach ($row as $key => $value) {
                    if ($key=='typeNo'){
                        $row1['typeNO']=$value;
                    }
                    elseif($key=='typeName'){
                        $row1['typeName']=$value;
                    }
                    else{
                        $row1['pic']=$value;
                    }
                }
                //                 $row1=array('typeNO'=>$typeNO,'typeName'=>$typeName);
                $data[]=$row1;
            }
            $code=1;
        }
        $retObj['code']=$code;
        $retObj['data']=$data;
        //return cReturnHandler::responseObj(1,  $retObj);
        return $retObj;
    }
    public static function getProductList($object){
        $category=$object['category'];
        $sqlStr="call getProductList('".$category."')";
        $result = Main::$mysql->sql_query($sqlStr);
        $retObj=array();
        $code=-1;
        $data=array();
        if( $result ){
            while($row = Main::$mysql->sql_fetch_array($result)){
                $row1=array();
                foreach ($row as $key => $value) {
                    switch($key){
                        case 'PROD_NO':
                            $row1['prodNO']=$value;
                            break;
                        case 'PROD_NAME':
                            $row1['prodName']=$value;
                            break;
                        case 'SUG_PRICE':
                            $row1['sugPrice']=$value;
                            break;
                        case 'COMP_PRICE':
                            $row1['COMP_PRICE']=$value;
                            break;
                        case 'PROD_UNIT':
                            $row1['prodUnit']=$value;
                            break;
                        case 'PV':
                            $row1['PV']=$value;
                            break;
                        case 'PS':
                            $row1['PS']=$value;
                            break;
                        case 'POINTS':
                            $row1['POINTS']=$value;
                            break;
                        case 'MB_PRICE':
                            $row1['mbPrice']=$value;
                            break;
                        case 'pic':
                            $row1['pic']=$value;
                            break;
                        case 'pic2':
                            $row1['pic2']=$value;
                            break;
                        case 'COST':
                            $row1['COST']=$value;
                            break;
                        case 'chk':
                            $row1['chk']=$value;
                            break;
                    }
                }
//                 $row1=array(
//                     'prodNO'=>$PROD_NO,
//                     'prodName'=>$PROD_NAME,
//                     'sugPrice'=>$SUG_PRICE,
//                     'COMP_PRICE'=>$COMP_PRICE,
//                     'prodUnit'=>$PROD_UNIT,
//                     'PV'=>$PV,
//                     'PS'=>$PS,
//                     'POINTS'=>$POINTS,
//                     'mbPrice'=>$MB_PRICE,
//                     'pic'=>$pic,//小圖
//                     'pic2'=>$pic2,//大圖
//                     'COST'=>$COST,
//                     'chk'=>$chk,
//                 );
                $data[]=$row1;
            }
            $code=1;
        }
        $retObj['code']=$code;
        $retObj['data']=$data;
        //return cReturnHandler::responseObj(1,  $retObj);
        return $retObj;
    }
    public static function getORGSEQ_T($object){
        $account = $object['account'];
        $sqlStr="call getOrgTDATA('".$account."')";
        $result = Main::$mysql->sql_multi_query($sqlStr);
        $retObj = array();
        $data= array();
        $code=0;
        if(is_object($result)&&(Main::$mysql->sql_num_rows($result)>=0)){
            $data=array();
            foreach($result as $key=>$row){
                $data[]=$row;
            }
            $retObj[]=$data;
            $code=1;
        }
        if( $result ){
            $code=1;
            $retObj['data']=$result;
        }
        $retObj['code']=$code;
        return $retObj;
    }
    public static function SunShipReceiveData($object){
        $web=$object['web'];
        $Td=$object['Td'];
        $buysafeno=$object['buysafeno'];
        $MN=$object['MN'];
        $note1=$object['note1'];
        $note2=$object['note2'];
//         $errCode=$object['errCode'];
        $SendType=$object['SendType'];
        $CargoNo=$object['CargoNo'];
        $StoreID=$object['StoreID'];
        $StoreName=$object['StoreName'];
        $StoreType=$object['StoreType'];
        $StoreMsg=$object['StoreMsg'];
        
        $sqlStr="call payment.SunShipReceiveData('$web','$Td','$buysafeno',$MN,'$SendType','$CargoNo','$StoreID','$StoreName','$StoreType','$StoreMsg')";
        $result = Main::$mysql->sql_query($sqlStr);
        $retObj=array();
        $code=0;
        $data=array();
        if( $result ){
            $row = Main::$mysql->sql_fetch_array($result);
            //$res = $row['res'];
            if ($row['LID']>0)
                $code=1;
            else
                $code=0;
        }
        $retObj['code']=$code;
        //return cReturnHandler::responseObj(1,  $retObj);
        return $retObj;        
    }
    public static function SunshipLogisticsStatusUpdate($object){
        $iTID=$object['iTID'];
        $iStoreType=$object['iStoreType'];
        $iSToreMsg=$object['iSToreMsg'];
        $sqlStr="call payment.SunshipLogisticsStatusUpdate('$iTID','$iStoreType','$iSToreMsg')";
        $result = Main::$mysql->sql_query($sqlStr);
        $retObj=array();
        $code=0;
        $data=array();
        if( $result ){
            $row = Main::$mysql->sql_fetch_array($result);
            //$res = $row['res'];
            if ($row['res']>0)
                $code=1;
        }
        $retObj['code']=$code;
        //return cReturnHandler::responseObj(1,  $retObj);
        return $retObj;
    }
    public static function SunShipPaidData($object){
        $web=$object['web'];
        $Td=$object['Td'];
        $buysafeno=$object['buysafeno'];
        $MN=$object['MN'];
        $errCode=$object['errCode'];
        $errmsg=$object['errmsg'];
        $CargoNo=$object['CargoNo'];
        $InvoiceNo=$object['InvoiceNo'];       
        $sqlStr="call payment.SunShipPaidData('$web','$Td','$buysafeno',$MN,'$errCode','$CargoNo','$errmsg','$InvoiceNo')";
        $result = Main::$mysql->sql_query($sqlStr);
        $retObj=array();
        $code=0;
        $data=array();
        if( $result ){
            $row = Main::$mysql->sql_fetch_array($result);
            //$res = $row['res'];
            if ($row['errorCode']>0)
                $code=1;
            else
                $code=0;
        }
        $retObj['code']=$code;
        //return cReturnHandler::responseObj(1,  $retObj);
        return $retObj;
    }
}