<?php
namespace report\user;

use report\base\ApiHandler;

class sms{
    private $User='?username='.SMS_USER.'&password='.SMS_PWD;

    public static function sendPWD($mtel,$msg){
        $User='?username='.SMS_USER.'&password='.SMS_PWD;
        $url= SMS_API_URL.'api/mtk/SmSend'.$User;
        $url=$url."&dstaddr=".$mtel;
        $url=$url.'&smbody='.urlencode($msg.';');
        $url=$url.'&CharsetURL=UTF-8';
        $obj=null;
        $ct=0;
        while($ct<5 && $obj==null){
            $output=sms::send($url);
            //$output="[1]\nmsgid=1626948424\nstatuscode=1\nAccountPoint=290";
            $obj=sms::parseOneMessage($output);
            $ct++;
        }
        $query = array(
            'mtel' => $mtel,
            'key' => $msg,
            'str' => $url,
            'workAbled'=> -1,
            'accountPoint' => -1,
        );
        $ret=array();
        if ($obj!=null){
            if ($obj['stausCode']=='1'){
                $query['workAbled']=true;
                $ret['code']=1;
            }
            else{
                $ret['code']=0;
            }
            $query['accountPoint']=$obj['AccountPoint'];
        }
        $result = ApiHandler::callApi('sendMessage', $query);
        $ret['record']=$result['code'];
        return $ret;
    }
    
    public static function sendOneMessage($mtel,$key){
        $User='?username='.SMS_USER.'&password='.SMS_PWD;
        $url= SMS_API_URL.'api/mtk/SmSend'.$User;
        $url=$url."&dstaddr=".$mtel;
        $url=$url.'&smbody='.urlencode('您的驗證碼為：'.$key.';');
        $url=$url.'&CharsetURL=UTF-8';
        $obj=null;
        $ct=0;
        while($ct<5 && $obj==null){
            $output=sms::send($url);
            //$output="[1]\nmsgid=1626948424\nstatuscode=1\nAccountPoint=290";
            $obj=sms::parseOneMessage($output);
            $ct++;
        }
        $query = array(
            'mtel' => $mtel,
            'key' => $key,
            'str' => $url,
            'workAbled'=> -1,
            'accountPoint' => -1,
        );
        $ret=array();
        if ($obj!=null){
            if ($obj['stausCode']=='1'){
                $query['workAbled']=true;
                $ret['code']=1;
            }
            else{
                $ret['code']=0;
            }
            $query['accountPoint']=$obj['AccountPoint'];
        }
        $result = ApiHandler::callApi('sendMessage', $query);
        $ret['record']=$result['code'];
        return $ret;
    }
    
    public static function send($url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
    
    public static function parseOneMessage($str){
        $obj=null;
        if (($str!=null)&&($str!='')){
            $arr = preg_split("/\r\n|\n|\r/", $str);
            $count=sizeof($arr);
            for($i=0;$i<$count;$i++){
                $tmp=explode('=',$arr[$i]);
                switch (strtolower($tmp[0])){
                    case 'msgid':
                        $msgid=$tmp[1];
                        break;
                    case 'statuscode':
                        $stausCode=$tmp[1];
                        break;
                    case 'accountpoint':
                        $AccountPoint=$tmp[1];
                        break;
                }
            }
            $obj= array(
                'msgid' => $msgid,
                'stausCode' => $stausCode,
                'AccountPoint' => $AccountPoint,
            );
        }
        return $obj;
    }
}