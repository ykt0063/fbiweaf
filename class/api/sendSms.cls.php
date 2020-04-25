<?php
namespace api\user;

use core\main\Main;
use core\response\cReturnHandler;

class sendSms {
    public function __construct(){
        
    }
    
    public static function sendMessage($object){
        $mtel=$object['mtel'];
        $key=$object['key'];
        $str=$object['str'];
        $workAbled=$object['workAbled'];
        $accountPoint=$object['accountPoint'];
        $sqlStr="call smsSendMessage('$mtel','$key','$str','$workAbled','$accountPoint')";
        $result = Main::$mysql->sql_query($sqlStr);
        $obj=array();
        if( $result ){
            $row = Main::$mysql->sql_fetch_array($result);
            $code=$row['res'];
            $obj['code']=$code;
        }
        else{
            $obj['code']=-1;
        }
        $obj['code']=1;
        return cReturnHandler::responseObj(1,  $obj);
    }
    
    public static function verify($object){
        $account=$object['account'];
        $password=$object['password'];
        $sqlStr="call smsCheckKey('$account','$password')";
        $result = Main::$mysql->sql_query($sqlStr);
        $obj=array();
                if( $result ){
                    $row = Main::$mysql->sql_fetch_array($result);
                    $code=$row['res'];
                    $obj['code']=$code;

                    //$msg=$row['msg'];
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
                    $obj['userInfo']['token']='';
                    $obj['userInfo']['accountLevel']='';
                    $obj['userInfo']['guid']=$json->{'MB_NO'};
                    $obj['userInfo']['sid']='';
                }
                else{
                    $obj['code']=-1;
                }
            //$obj['code']=1;
            return cReturnHandler::responseObj(1,  $obj);
    }
    
}