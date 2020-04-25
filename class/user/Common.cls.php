<?php
namespace report\user;

use report\base\ApiHandler;
use report\base\Json;

class Common{
    public static function getPostCode($district){
        $query=array('district'=>$district);
        $result = ApiHandler::callApi('getPostCode', $query);
        if(!isset($result['code']) || $result['code'] != 1){
            $code=-1;
            $desc = isset($result['desc']) ? $result['desc'] : '';
            $msg = Json::encode($result);
            //                 $msg =ReturnHandler::responseObj(999, null, $desc);
        }
        else{
            $code=0;
            $data=array();
            if (strlen($district)==0){
                for($i=0;$i<sizeof($result['data'][0]);$i++){
                    $data[]=$result['data'][0][$i][0];
                }
            }
            else{
                for($i=0;$i<sizeof($result['data'][0]);$i++){
                    $data[]=$result['data'][0][$i];
                }
            }
            $msg='';
            //$msg = Json::encode($result);
            //$msg='網站:'.WEB_SITE_URL.','.$result['desc'];
        }
        $retObj = array(
            'code' => $code,
            'desc' => $msg,
            'data' => $data,
        );
        return $retObj;
    }
}