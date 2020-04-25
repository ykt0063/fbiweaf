<?php

namespace api\user;

use core\main\Main;
use core\response\cReturnHandler;
use report\base\Json;

class UserAccount {
    private $account;
    private $login=false;

    public function __construct(){        
    }
    public static function userComission($object){
        $sqlStr="call payment.getNewUserComission()";
        $result = Main::$mysql->sql_query($sqlStr);
        $obj=array();
        $code=1;
        $data=array();
        if( $result ){
            $row = Main::$mysql->sql_fetch_array($result);
            $obj['comission']=$row['comission'];
            $obj['code']=1;
        }
        else{
            $obj['code']=-1;
        }
        return cReturnHandler::responseObj(1,  $obj);
    }
    public static function getRedSunHistoryData($object){
        $bdate=$object['bdate'];
        $edate=$object['edate'];
        $sqlStr="call ".DBName.".getRedSunHistoryData('$bdate','$edate')";
        $result = Main::$mysql->sql_query($sqlStr);
        $obj=array();
        $code=1;
        $data=array();
        if( $result){            
            foreach($result as $key=>$row){
                $data[]=$row;
            }
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$data;
        return cReturnHandler::responseObj(1,  $obj);        
    }
    public static function getAdminlist($object){
        $sqlStr="call ".DBName.".getAdminlist()";
        $result = Main::$mysql->sql_query($sqlStr);
        $obj=array();
        $code=1;
        if( is_object($result)&&(Main::$mysql->sql_num_rows($result)>0)){
            $code=0;
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$result;
        return cReturnHandler::responseObj(1,  $obj);
    }
    public static function setAdminlist($object){
        $arr=$object['arr'];
        $str=$arr[0];
        $len=count($arr);
        for($i=1;$i<$len;$i++){
            $str=$str.":".$arr[$i];
        }
        $sqlStr="call ".DBName.".setAdminlist(\"".$str."\",".$len.")";
        $result = Main::$mysql->sql_query($sqlStr);
        $obj=array();
        $code=1;
        if($result){
            $code=0;
        }
        $obj=array();
        $obj['code']=$code;
        return cReturnHandler::responseObj(1,  $obj);
    }
    public static function login($object){
         $account=$object['account'];
         $password=$object['password'];
         $sqlStr="call Login('$account','$password')";
         $result = Main::$mysql->sql_query($sqlStr);
         $obj=array();
         if( $result ){
             $row = Main::$mysql->sql_fetch_array($result);
             $code=$row['res'];
             if ($code==1){
                 $msg=$row['msg'];
                 //echo $msg.PHP_EOL;
                 $json=json_decode($row['msg']);
                 $obj['userInfo']['account']=$json->{'MB_NO'};
                 $obj['userInfo']['name']=$json->{'MB_NAME'};
                 $obj['userInfo']['role']=$json->{'role'};
                 //$obj['userInfo']['role']='';
                 // $obj['userInfo']['checkCode']=$json->{'checkCode'};
                 $obj['userInfo']['checkCode']=$json->{'MB_NO'};
                 $obj['verifyData']['token']='';
                 $obj['tempToken']['token']='';
                 $obj['weekNo']=$json->{'WeekNo'};
		         $obj['eRate']=$json->{'eRate'};
                 $obj['userInfo']['token']='';
                 $obj['userInfo']['accountLevel']='';
                 $obj['userInfo']['guid']=$json->{'MB_NO'};
                 $obj['userInfo']['sid']='';
             }
             $obj['code']=$code;
         }
         else{
             $obj['code']=-1;
             $obj['desc']= "account:".$account.",password:".$password;
         }
         return cReturnHandler::responseObj(1,  $obj);
     }
     
     public static function getProfile(){
         
     }
     public static function setProfile(){
         
     }
     
     public static function changePwd($object){
         $account=$object['account'];
         $oldpassword=$object['oldpassword'];
         $newpassword=$object['newpassword'];
         $sqlStr="call ChangePWD('$account','$oldpassword','$newpassword')";
         $result = Main::$mysql->sql_query($sqlStr);
         $obj=array();
         if( $result ){
             $row = Main::$mysql->sql_fetch_array($result);
             $code=$row['res'];
             if ($code==1){
                 $msg=$row['msg'];
             }
             $obj['code']=$code;
         }
         else{
             $obj['code']=-1;
             $obj['desc']= "account:".$account.",oldpassword:".$oldpassword.",newpassword:".$newpassword;
         }
         return cReturnHandler::responseObj(1,  $obj);
             
     }
     public static function forgetPWD($object){
         $account=$object['account'];
         $idWay=$object['idWay'];
         $name=$object['name'];
         $email=$object['email'];
         $sqlStr="call ForgetPWD('$account',$idWay,'$name','$email')";
         $result = Main::$mysql->sql_query($sqlStr);
         $obj=array();
         if( $result ){
             $row = Main::$mysql->sql_fetch_array($result);
             $code=$row['res'];
             $msg=$row['msg'];
             $obj['code']=$code;
             $obj['desc']= $msg;
             
         }
         else{
             $obj['code']=-1;
             $obj['desc']= "error";
         }
         return cReturnHandler::responseObj(1,  $obj);
         
     }
     public static function editData($object){
         $account=$object['account'];
         $name=$object['name'];
         $addr=$object['addr'];
         $email=$object['email'];
         $tel=$object['tel'];
         $birth=$object['birth'];
         $sqlStr="call EditData('$account','$name','$tel','$addr','$email','$birth','')";
         $result = Main::$mysql->sql_query($sqlStr);
         $obj=array();
         if( $result ){
             $row = Main::$mysql->sql_fetch_array($result);
             $code=$row['res'];
             $msg=$row['msg'];
             $obj['code']=$code;
             $obj['desc']= $msg;
             
         }
         else{
             $obj['code']=-1;
             $obj['desc']= "error";
         }
         return cReturnHandler::responseObj(1,  $obj);
         
     }
     public static function getPersonalData($object){
         $account=$object['account'];
         $sqlStr="call getPersonalData('$account')";
         $result = Main::$mysql->sql_query($sqlStr);
         $obj=array();
         if( $result ){
             $row = Main::$mysql->sql_fetch_array($result);
             $code=$row['res'];
             $msg=$row;
             $obj['code']=$code;
             $obj['desc']= $row;
             
         }
         else{
             $obj['code']=-1;
             $obj['desc']= "error";
         }
         return cReturnHandler::responseObj(1,  $obj);
         
     }
     public static function newAccount(){
         
     }
     public static function changeLevel(){
         
     }
     public static function getUser($object){
         $obj=array();
         $obj['code']=1;
         return $obj;
     }
     public static function getSunshipData($object){
         $web=$object['web'];
         $td=$object['td'];
         $CargoNo=$object['CargoNo'];
         $sqlStr="call payment.getSunshipData('$web','$td','$CargoNo')";
         $result = Main::$mysql->sql_query($sqlStr);
         $obj=array();
         if( $result ){
             $row = Main::$mysql->sql_fetch_array($result);
             $obj['data']=$row['PWD'];
             $obj['code']=1;
         }
         else{
             $obj['code']=-1;
         }
         return cReturnHandler::responseObj(1,  $obj);
     }
     public static function getComission($object){
         $account=$object['account'];
         $sqlStr="call getComission('$account')";
         $result = Main::$mysql->sql_query($sqlStr);
         $obj=array();
         if( $result ){
             $row = Main::$mysql->sql_fetch_array($result);
             $code=$row['res'];
             if ($code==1){
                 $obj['eff']=$row['eff'];
                 $obj['uneff']=$row['uneff'];
             }
             $obj['code']=$code;
         }
         else{
             $obj['code']=-1;
         }
         return cReturnHandler::responseObj(1,  $obj);
     }
}
