<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace report\base;

use report\user\Session;
use core\base\fun;
class ApiHandler
{
    //預設的api url(管理端系統)
    private static $_defaultApiUrl = API_URL;
    public static $requestBufferArr = array();
    private static $requestBufferCount = 0;
    private static $lastObj = NULL;

    public static function getApiUrl($key = '')
    {
    	global $saApiUrlArray;
    	
//     	//控端環境的話，特殊判斷
//     	if(SaSystem::isSaEnvironment()){
    		
//     		return SaSystem::apiInSa($key);	
//     	}
    	
    	$keyArr = explode('/', $key);
    	//一般管端api
    	$apiUrl = self::$_defaultApiUrl;
    	//判斷是否key為控端功能
    	if(count($keyArr) > 1){
    		if(isset($saApiUrlArray[$keyArr[0]])){
    			$apiUrl = $saApiUrlArray[$keyArr[0]];
    		}
    	}
    	
    	$url = $apiUrl.$key;
    	return $url;
    }
     /*
     * API呼叫
     */
    public static function callApi($key = '', $obj = array(), $timeOut = 30, $test = FALSE )
    {
        global $debugIdArr;
        $result = fun::exeAPI($key, $obj);
        //$result = $this::exeAPI( $parAry[0], $requestObj );
           return $result;

//         $apiUrl = self::getApiUrl($key);
//         $sendObj = array('par'=>self::parHandler($obj));

//         $addStr = "";

//         if( in_array(Tool::getClientIp(), $debugIdArr) || strpos(Tool::getClientIp(), '192.168.0.') !== FALSE){
//             $addStr .= "apiURL: ".$apiUrl."<br/>";
//             $addStr .= "apiParameter: ".json_encode($obj)."<br/>";
//         }

//         self::$requestBufferArr[self::$requestBufferCount] = array();
//         self::$requestBufferArr[self::$requestBufferCount]['url'] = $apiUrl;
//         self::$requestBufferArr[self::$requestBufferCount]['request'] = self::$lastObj;

//         try {

//             $result = CurlHandler::post($apiUrl, $sendObj, $timeOut);
//             $addStr .= "result: ".$result."<br/>";
//             $decodeStr = PtEncryption::decrypt(PES_KEY, $result);
//             //$addStr .= "result json: ".$decodeStr."<br/>";

//             self::$requestBufferArr[self::$requestBufferCount]['response'] = $resultObj = Json::decode($decodeStr);
            
//             $resultObj['requestUrl'] = $apiUrl;

//             $resultObj['debugArr'] = array();
//             $resultObj['debugArr']['apiURL'] = $apiUrl;
//             $resultObj['debugArr']['apiParameterObj'] = json_encode($obj);
//             $resultObj['debugArr']['apiParameter'] = $sendObj;
//             $resultObj['debugArr']['result'] = $decodeStr;

//             self::$requestBufferCount++;
            
            
//             if( !isset($resultObj['code']) ){
//                 self::showApiError(1, $addStr);
//             }else{

//                 //若執行成功呼叫管端API寫入log
//                 if ($resultObj['code'] == '1') {
//                     self::insertOperatorLog($key, $obj);
//                 }

//                 return $resultObj;
//             }
            
//         } catch (\Exception $e) {
//             self::showApiError(2, $addStr);
//         }
    }
    
    private static function showApiError($posId, $addStr, $decodeStr = '')
    {
//     	echo('<center><h1>目前线路不稳定，请稍后重整页面，谢谢!['.Tool::getClientIp().']['.$posId.']</h1></center><center>'.$addStr."</center>");
//     	exit();
    }
    
    private static function parHandler( $obj )
    {
//         $token = Session::get('token');
//         if($token){
//             $obj['token'] = $token;
//         }

//         return PtEncryption::encrypt( PES_KEY, Json::encode($obj));
    }
}
