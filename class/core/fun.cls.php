<?php
namespace core\base;
use core\config\SystemConfig;
use core\response\cReturnHandler;

use core\tool\Tool;
use core\tool\Json;
use core\main\Main;

use api\company\company;
use api\organization\Organization;
use api\user\UserAccount;
use api\work\workData;

//管端API設定檔
$funConfigArr = array();

//控端API設定檔
$saFunConfigArr = array();

//載入fun底下的功能
$funFolder = __DIR__.'/func/*.php';
foreach(glob($funFolder) as $funName){
    require_once($funName);
}

/*
 * 控制所有api的實作
 * op: api代碼
 * requestObj: api相關參數
 * type:管端或控端 sa:控端 其餘:管端
 */
class fun{
    private $funConfigArr = array();
    private $saFunConfigArr = array();
    
    static function init(){
        global $funConfigArr, $saFunConfigArr;
        $saFunConfigArr = array();
        $funConfigArr = array();
        $funFolder = __DIR__.'/func/*.php';
        foreach(glob($funFolder) as $funName){
            include($funName);
        }
    }
    static function exeAPI( $op, $requestObj, $type = '' )
    {
        global $funConfigArr, $saFunConfigArr;
        fun::init();
        $_thisFunConfigAry = ( !empty($type) ? $saFunConfigArr : $funConfigArr );
        $result=null;
        //判断要呼叫的op
        if(isset($_thisFunConfigAry[$op])){
            $apiClass = $_thisFunConfigAry[$op]['class'];
            $apiFunction = $_thisFunConfigAry[$op]['fun'];
            
            $result = fun::call_user_func( array($apiClass, $apiFunction), $requestObj );
        }else{
            //没有定义的API 回报错误
            //$result = ReturnHandler::responseObj(96,null,"[fun.inc: op:".$op." type:".$type."]");
        }
        
        return $result;
    }
    
    function responseHandler($result, $isEndoce)
    {
        //global $parAry;
        
        $responseStr = Json::encode($result);
        
//         if (!empty($parAry[1])) {
//             insertLog("cmd=".$parAry[1]." response=".$responseStr ." api time=" . Main::$timer->totaltime());
//         } else if (!empty($parAry[0])) {
//             insertLog("cmd=".$parAry[0]." response=".$responseStr ." api time=" . Main::$timer->totaltime());
//         }
        
        //     if( $isEndoce ){
        //         $responseStr = PtEncryption::encrypt(SystemConfig::$pesKey, $responseStr);
        //     }
        
        exit( $responseStr );
    }
    
    function insertLog($str)
    {
        
        if( !API_LOG_RECORD ) return;
        
        if (!empty(Main::$apiPathAry[0])) {
            
            Tool::syslog($str, "apiLog_".Main::$apiPathAry[0]);
            
        } else {
            
            Tool::syslog($str, "apiLog");
        }
    }
    
    function insertApiLogToSa($parAry = [], $requestObj = [], $result = [], $sqlStr = '')
    {
        //有需要log的關鍵字才紀錄
        $KeyStr = implode('/', $parAry);
        $allowLogKey = [];
        if(!in_array($KeyStr, $allowLogKey)){
            return;
        }
        
        $parms = [
            'host' => $_SERVER['HTTP_HOST'],
            'parAry' => $parAry,
            'requestObj' => $requestObj,
            'result' => $result,
            'apiTime' => Main::$timer->getStartTime(),
            'sqlStr' => $sqlStr,
        ];
        
        //     $result = \core\adminCallSa\ApiHandler::send_pes_request(SA_API_INFORMATION.'insertApiLog',$parms);
    }
    static function call_user_func( $objArray, $requestObj){
        $clsName = $objArray[0];
        $funName = $objArray[1];
        $result = $clsName::$funName($requestObj);
        return $result;
    }
}
