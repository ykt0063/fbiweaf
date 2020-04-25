<?php
namespace api\order;
use core\main\Main;
use core\response\cReturnHandler;
use report\base\Json;

class Order {
    public function __construct(){
        
    }
    public static function getEXLists($object){
        $account=$object['account'];
        $bdate=$object['bdate'];
        $edate=$object['edate'];
        $sqlStr="call getEXLists('$account','$bdate','$edate')";
        //echo "<br>".$sqlStr."<br>";
        $result = Main::$mysql->sql_query($sqlStr);
        $code=1;
        $data=array();
        if(is_object($result)&&(Main::$mysql->sql_num_rows($result)>0)){
            foreach($result as $key=>$row){
                $data[]=$row;
            }
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$data;
        return cReturnHandler::responseObj(1,  $obj);
    }
    
    public static function getOHistory($object){
        $account=$object['account'];
        $bdate=$object['bdate'];
        $edate=$object['edate'];
        $sqlStr="call getOrderList('$account','$bdate','$edate')";
        $result = Main::$mysql->sql_query($sqlStr);
        $code=1;
	$data=array();
        if(is_object($result)&&(Main::$mysql->sql_num_rows($result)>0)){
            $data=array();
            foreach($result as $key=>$row){
                $data[]=$row;
            }
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$data;
        return cReturnHandler::responseObj(1,  $obj);        
    }
    public static function getODetail($object){
        $account=$object['account'];
        $ordNO=$object['ordNO'];
        $sqlStr="call getOrderDetail('$account','$ordNO')";
        $result = Main::$mysql->sql_multi_query($sqlStr);
        $code=1;
        if($result){
            $data=array();
            foreach($result as $row){
                $data[]=$row;
            }
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$data;
        return cReturnHandler::responseObj(1,  $obj);
    }
    public static function showProduct($object){
        $kind = $object['kind'];
        if ($kind==1){
            $sqlStr="call ShowProduct(1,'')";
        }
        else{
            $category=$object['category'];
            $sqlStr="call getCategoriesProduct('".$category."')";
        }
        $result = Main::$mysql->sql_query($sqlStr);
        $code=1;
        if(is_object($result)&&(Main::$mysql->sql_num_rows($result)>0)){
            $code=0;
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$result;
        return cReturnHandler::responseObj(1,  $obj);        
    }
    public static function showProduct1($object){
        $kind = $object['kind'];
        $code=1;
        if ($kind==1){
            $sqlStr="call getProductCategoriesList1()";
            $result = Main::$mysql->sql_query($sqlStr);
            if(is_object($result)&&(Main::$mysql->sql_num_rows($result)>0)){
                $code=0;
            }
        }
        else{
            $category=$object['category'];
//             $sqlStr="call getCategoriesProduct1('".$category."')";
//             $result = Main::$mysql->sql_multi_query($sqlStr);
//             //$result = Main::$mysql->sql_query($sqlStr);
//             if( count($result)>0 ){
//                 $code=0;
//             }
            
            $result=array();
            $sqlStr="call getCategoriesProduct1(1,'".$category."')";
            $res = Main::$mysql->sql_query($sqlStr);
            if(is_object($res)&&(Main::$mysql->sql_num_rows($res)>=0)){
                $data=array();
                foreach($res as $key=>$row){
                    $data[]=$row;
                }
                $result[]=$data;
                $sqlStr="call getCategoriesProduct1(2,'".$category."')";
                $res = Main::$mysql->sql_query($sqlStr);
                if(is_object($res)&&(Main::$mysql->sql_num_rows($res)>=0)){
                    $data=array();
                    foreach($res as $key=>$row){
                        $data[]=$row;
                    }
                    $result[]=$data;
                    $code=0;
                }                
            }
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$result;
        return cReturnHandler::responseObj(1,  $obj);
    }
    public static function showProduct2($object){
        $kind = $object['kind'];
        $code=1;
        if ($kind==1){
            $sqlStr="call getProductList1()";
            $result = Main::$mysql->sql_query($sqlStr);
            if(is_object($result)&&(Main::$mysql->sql_num_rows($result)>0)){
                $code=0;
            }
        }
        else{
             
//             $sqlStr="call ShowProduct(2,'".$prodID."')";
//             $result = Main::$mysql->sql_multi_query($sqlStr);
//             //$result = Main::$mysql->sql_query($sqlStr);
//             if( count($result)>0 ){
//                 $code=0;
//             }
            $prodID=$object['prodID'];
            $result=array();
            $sqlStr="call ShowProduct(2,'".$prodID."')";
            $res = Main::$mysql->sql_query($sqlStr);
            if(is_object($res)&&(Main::$mysql->sql_num_rows($res)>=0)){
                $data=array();
                foreach($res as $key=>$row){
                    $data[]=$row;
                }
                $result[]=$data;
                $sqlStr="call ShowProduct(3,'".$prodID."')";
                $res = Main::$mysql->sql_query($sqlStr);
                if(is_object($res)&&(Main::$mysql->sql_num_rows($res)>=0)){
                    $data=array();
                    foreach($res as $key=>$row){
                        $data[]=$row;
                    }
                    $result[]=$data;
                    $code=0;
                }
            }
            
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$result;
        return cReturnHandler::responseObj(1,  $obj);
    }
    public static function setCategory1($object){
        $categoryID=$object['categoryID'];
        $data=$object['data'];
        $selStr='';
        $code=1;
        $ct=0;
        foreach($data as $row){
            if($ct==0){
                $selStr=$selStr.$row;
            }
            else{
                $selStr=$selStr.":".$row;
            }
            $ct=$ct+1;
        }
        $sqlStr="call setProductCategories('".$categoryID."','".$selStr."',".$ct.")";
        $result = Main::$mysql->sql_query($sqlStr);
        if($result){
            $code=0;
        }
        $obj=array();
        $obj['code']=$code;
        return cReturnHandler::responseObj(1,  $obj);
    }
    public static function getProductDetail($object){
        $prodNo=$object['prodNo'];
        $sqlStr="call ShowProduct(2,\"".$prodNo."\")";
        $result=array();
        //         $result = Main::$mysql->sql_query($sqlStr);
        //         $code=1;
        //         if(is_object($result)&& (Main::$mysql->sql_num_rows($result)>0)){
        //             $code=0;
        //         }
//         $result = Main::$mysql->sql_multi_query($sqlStr);
        $res = Main::$mysql->sql_query($sqlStr);
        $code=1;
        //$result = Main::$mysql->sql_query($sqlStr);
        if(is_object($res)&&(Main::$mysql->sql_num_rows($res)>=0)){
            $data=array();
            foreach($res as $key=>$row){
                $data[]=$row;
            }
            $result[]=$data;
            $sqlStr="call ShowProduct(3,'".$prodNo."')";
            $res = Main::$mysql->sql_query($sqlStr);
            if(is_object($res)&&(Main::$mysql->sql_num_rows($res)>=0)){
                $data=array();
                foreach($res as $key=>$row){
                    $data[]=$row;
                }
                $result[]=$data;
                $code=0;
            }
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$result;
        return cReturnHandler::responseObj(1,  $obj);
        
    }
    public static function setProductDetail($object){
        $prodID=$object['prodID'];
        $mbPrice=$object['mbPrice'];
        $netPrice=$object['netPrice'];
        $statusCode=$object['statusCode'];
        $note=$object['note'];
        $spec=$object['spec'];
        $specNumber=$object['specNumber'];
        $pic=$object['pic'];
        $pic0=$object['pic0'];
        $pic1=$object['pic1'];
        $pic2=$object['pic2'];
        $pic3=$object['pic3'];
        $pic4=$object['pic4'];
        $sqlStr="call SetProductData(\"".$prodID."\",".$mbPrice.",".$netPrice.",".$statusCode.",\"".$note."\",\"".$spec."\",\"".$pic."\",\"".$pic0."\",\"".$pic1."\",\"".$pic2."\",\"".$pic3."\",\"".$pic4."\",".$specNumber.")";
        //echo $sqlStr.'<BR>';
        $result = Main::$mysql->sql_query($sqlStr);
        $code=1;
        if($result){
             $code=0;
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$result;
        return cReturnHandler::responseObj(1,  $obj);
    }
    public static function setOrder($object){
        $mbno=$object['MBNO'];
        $totalPrice=$object['TotalPrice'];
        $prodInfo=$object['ProdInfo'];
        $prodNumber=$object['ProdNumber'];
        $term=$object['Term'];
        $payMethod=$object['payMethod'];
        $objStr=$object['objStr'];
        $transFee=$object['transFee'];
        $payEP=$object['payEP'];      
        $transCode=$object['transCode'];
        $sqlStr="call payment.setOrder('".$mbno."',".$totalPrice.",'".$prodInfo."','".$payMethod."','".$term."',".$prodNumber.",".$transFee.",'".$objStr."',".$payEP.")";
//         $sqlStr="call payment.setOrder('".$mbno."',".$totalPrice.",'".$prodInfo."','".$payMethod."','".$term."',".$prodNumber.",".$transFee.",'".$objStr."',".$payEP.",'".$transCode."')";
        //Main::$mysql->beginTransaction();
        $result = Main::$mysql->sql_query($sqlStr);
//         if ($result){
//             //$row = Main::$mysql->sql_fetch_row($result);
//             $num=Main::$mysql->sql_num_rows($result);
//             $row=Main::$mysql->sql_fetch_array($result);
//             $obj=array();
//             foreach($row as $key=>$value){
//                 $obj[$key]=$value;
//             }
//             $result=$obj;
//             //Main::$mysql->commit();
//         }
//         else{
//             //Main::$mysql->rollBack ();
//         }
        $code=1;
        if(is_object($result) && (Main::$mysql->sql_num_rows($result)>0)){
            $code=0;
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$result;
        return cReturnHandler::responseObj(1,  $obj);
    }
    public static function setDBResponse($object){
        $obj=$object['obj'];
        $buysafeno=$obj['buysafeno'];
        $Td=$obj['Td'];
        $MN=$obj['MN'];
        $Name=$obj['Name'];
        $note1=$obj['note1'];
        $note2=$obj['note2'];
        $ApproveCode=$obj['ApproveCode'];
        $Card_NO=$obj['Card_NO'];
        $sqlStr="INSERT INTO payment.Response";
        $sqlStr=$sqlStr."(buysafeno,Td,MN,Name,note1,note2,ApproveCode,Card_NO)VALUE";
        $sqlStr=$sqlStr."('$buysafeno','$Td','$MN','$Name','$note1','$note2','$ApproveCode','$Card_NO')";
        $result = Main::$mysql->sql_query($sqlStr);
        
        $web=$object['web'];
        $supplierTradeNo=$object['supplierTradeNo'];
        $tradeNo=$object['tradeNo'];
        $price=$object['price'];
        $approveCode=$object['approveCode'];
        $cardNo=$object['cardNo'];
        $errCode=$object['errCode'];
        $errMsg=$object['errMsg'];
        $invoiceNo=$object['invoiceNo'];
        $postData=$object['postData'];
        $transCode=$object['transCode'];
        $tmp=Json::decode($postData);
        $CargoNo=$tmp['CargoNo'];
        $StoreID=$tmp['StoreID'];
        $StoreName=urldecode($tmp['StoreName']);
        $postData="";
        $postData=base64_encode($postData);
        
        $sqlStr="call payment.setResponse('".$web."','".$supplierTradeNo."','".$tradeNo."','".$price."','".$approveCode."','".$cardNo."','".$errCode."','".$errMsg."','".$invoiceNo."','".$postData."','".$transCode."','".$CargoNo."','".$StoreID."','".$StoreName."')";
        $result = Main::$mysql->sql_query($sqlStr);
        $code=1;
        if(is_object($result) && (Main::$mysql->sql_num_rows($result)>0)){
            $code=0;
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$result;
        return cReturnHandler::responseObj(1,  $obj);
    }
    public static function setProductActivity($object){
        $tag=$object['tag'];
        $begin=$object['begin'];
        $end=$object['end'];
        $data=$object['data'];
        $dNumber=$object['dNumber'];
        $sqlStr="call setProductActivity(".$tag.",\"".$begin."\",\"".$end."\",\"".$data."\",\"".$dNumber."\")";
        if ($begin==false && $end==false){
            $sqlStr="call setProductActivity(".$tag.",null,null,\"".$data."\",\"".$dNumber."\")";
            
        }
        $result = Main::$mysql->sql_query($sqlStr);
        $code=1;
        if($result){
            $code=0;
        }
        $obj=array();
        $obj['code']=$code;
        return cReturnHandler::responseObj(1,  $obj);
    }
    public static function getProductActivity($object){
        $tag=$object['tag'];
        $sqlStr="call getProductActivity(".$tag.")";
        $result = Main::$mysql->sql_query($sqlStr);
        $code=1;
        if(is_object($result) && (Main::$mysql->sql_num_rows($result)>0)){
            $code=0;
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$result;
        return cReturnHandler::responseObj(1,  $obj);
    }
    public static function getProductActivityLimitTime($object){
        $sqlStr="call getProductActivityLimitTime()";
        $result = Main::$mysql->sql_query($sqlStr);
        $code=1;
        if(is_object($result) && (Main::$mysql->sql_num_rows($result)>0)){
            $code=0;
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$result;
        return cReturnHandler::responseObj(1,  $obj);
    }
    public static function setOfficialOrder($object){
        $tid=$object['tid'];
        $RECEIVER=$object['RECEIVER'];
        $TEL=$object['TEL'];
        $ADD_SEND=$object['ADD_SEND'];
        $POST_NO=$object['POST_NO'];
        $From_WHERE=$object['From_WHERE'];
        $REMARK=$object['REMARK'];
        $ORDER_MONEY=$object['ORDER_MONEY'];
        $ORDER_PV=$object['ORDER_PV'];
        $TOTAL_MONEY=$object['TOTAL_MONEY'];
        $PV=$object['PV'];
        $SEND_MONEY=$object['SEND_MONEY'];
        $detail=$object['detail'];
        $number=$object['number'];
        $DATA_FLAG=$object['DATA_FLAG'];
        $payEP=$object['payEP'];
        $cCost=$object['cCost'];
        if ($payEP=='') $payEP=0;
        if ($cCost=='') $cCost=0;
        $transCode=$object['transCode'];
        $InvoiceNo=$object['InvoiceNo'];
        $CargoNo=$object['CargoNo'];
        $Card_NO=$object['Card_NO'];
        $ApproveCode=$object['ApproveCode'];
        if ($transCode!='1'){
            $storeID=$object['storeID'];
            $storeName=$object['storeName'];
            $storeAddr=$object['storeAddr'];
        }
        else{
            $storeID='';
            $storeName='';
            $storeAddr='';
        }
        $invoiceType=$object['invoiceType'];
        $invoiceName=$object['invoiceName'];
        $invoiceNumber=$object['invoiceNumber'];
        $invoiceTitle=$object['invoiceTitle'];
        $sqlStr="call payment.setOfficialOrder(\"".$tid."\",\"".$RECEIVER."\",\"".$TEL."\",\"".$ADD_SEND.
        "\",\"".$POST_NO."\",\"".$From_WHERE."\",\"".$REMARK."\",".$ORDER_MONEY.",".$ORDER_PV.
        ",".$TOTAL_MONEY.",".$PV.",".$SEND_MONEY.",\"".$detail."\",".$number.",\"".$DATA_FLAG."\",".$payEP.",".$cCost.",\"".$transCode."\",\"".
        $InvoiceNo."\",\"".$CargoNo."\",\"".$Card_NO."\",\"".$storeID."\",\"".$storeName."\",\"".$storeAddr."\",\"".$ApproveCode."\",\"".$invoiceType."\",\"".$invoiceNumber."\",\"".$invoiceTitle."\")";
        $result = Main::$mysql->sql_query($sqlStr);
        $code=1;
        if($result){
            $code=0;
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$result;
        return cReturnHandler::responseObj(1,  $obj);
    }
}
