<?php
namespace report\user;
use report\base\ApiHandler;
class comission{
    public static function getData($account){
        $query=array('account'=>$account);
        $result = ApiHandler::callApi('getComission', $query);
        //$result=array('code'=>1,'uneff'=>0,'eff'=>300);
        $obj=array();
        if(!isset($result['code']) || $result['code'] != 1){
            $obj['code']=-1;
        }
        else{
            $obj['code']=0;
            $obj['uneff']=$result['uneff'];
            $obj['eff']=$result['eff'];
        }
        return $obj;
    }
    public static function newUserComission(){
        $query=array();
        $result = ApiHandler::callApi('userComission', $query);
        //$result=array('code'=>1,'comission'=>300);
        $obj=array();
        $comission=0;
        if(!isset($result['code']) || $result['code'] != 1){
            $comission = 0;
        }
        else{
            $comission = $result['comission'];
        }
        return $comission;
    }
}
