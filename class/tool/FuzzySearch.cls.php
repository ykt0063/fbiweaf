<?php
namespace report\tool;

use report\base\ApiHandler;
use report\base\Json;
use report\user\Session;

class FuzzySearch{
    public static function searchButton($option,$parameter1,$parameter2=''){
        $parameter1=trim($parameter1);
        $parameter2=trim($parameter2);
        $code=0;
        $msg="";
        $data=null;
        if (empty($parameter1)&&(empty($parameter2))){
            $code=-2;
        }
        else{
            $query = array(
                'parameter1' => $parameter1,
                'parameter2' => $parameter2,
                'choice' => $option,
            );
            $result = ApiHandler::callApi('searchButton', $query);
            if(!isset($result['code']) || $result['code'] != 0){
                $code=-1;
                //                 $msg = ReturnHandler::responseObj(999, null, $desc);
            }
            else{
                $code=0;
                //$msg = Json::encode($result);
                $data=$result['data'];
            }
        }
        $retObj = array(
            'code' => $code,
            'desc' => $msg,
            'data' => $data,
        );
        return $retObj;
    }
    
}