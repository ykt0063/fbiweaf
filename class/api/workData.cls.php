<?php

namespace api\work;
use core\main\Main;
use core\response\cReturnHandler;

class workData {
    public function __construct(){
        
    }
    
    public static function getBonusData($object){
        $account=$object['account'];
        $weekNo=$object['weekNo'];
        $result=array();
        $code=1;
//         $sqlStr="call WeekNoListBonusReport('$account','$weekNo')";
//         $result = Main::$mysql->sql_multi_query($sqlStr);
//         if( count($result)>0 ){
//             $code=0;
//         }
        for ($i=0;$i<11;$i++){
            $sqlStr="call WeekNoListBonusReport($i,'$account','$weekNo')";
            $res = Main::$mysql->sql_query($sqlStr);
            if(is_object($res)&&(Main::$mysql->sql_num_rows($res)>=0)){
                $data=array();
                foreach($res as $key=>$row){
                    $data[]=$row;
                }
                $result[]=$data;
            }
            else{
                $i=13;
            }
        }
        if ($i==11){
            $code=0;
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$result;
        return cReturnHandler::responseObj(1,  $obj);
        
    }
    
    public static function getWeekNoList($object){
        
        $sqlStr="call WeekNoList()";
        $result = Main::$mysql->sql_query($sqlStr);
        $retObj=array();
        $code=-1;
        $data=array();
        if( $result ){
            while($row = Main::$mysql->sql_fetch_array($result)){
                $data[]=$row;
            }            
            $code=0;
        }
        $retObj['code']=$code;
        $retObj['data']=$data;
        //return cReturnHandler::responseObj(1,  $retObj);
        return $retObj;
    }
    
    public static function orderProduct(){
        
    }
    
    public static function setDeliveryData(){
        
    }
    
    public static function getOrderContent(){
        
    }
    
    public static function getSalesRecord(){
        
    }
}