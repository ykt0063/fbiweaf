<?php
namespace report\user;

use report\base\Json;
use report\base\ApiHandler;
// use report\response\ReturnHandler;
//use report\base\Tool;
// use report\base\Json;

class Auth{
    
    //add by ykt
    public static function editData($account, $name,$addr,$birth,$tel,$email){
        $query = array(
            'account' => $account,
            'name' => $name,
            'birth' => $birth,
            'tel' => $tel,
            'email'=>$email,
            'addr'=>$addr,
        );
        
        $result = ApiHandler::callApi('editData', $query);
        
        if(!isset($result['code']) || $result['code'] != 1){
            $code=-1;
            $desc = isset($result['desc']) ? $result['desc'] : '';
            $msg = Json::encode($result);
            //                 $msg =ReturnHandler::responseObj(999, null, $desc);
        }
        else{
            $code=0;
            $msg='';
            //$msg = Json::encode($result);
            //$msg='網站:'.WEB_SITE_URL.','.$result['desc'];
            $data=array();
        }
        $retObj = array(
            'code' => $code,
            'desc' => $msg,
            //             'data' => $data,
        );
        return $retObj;
    }
    public static function checkVerifyData($verifyData,$expireTime,$account){
        $account = trim($account);
        $verifyData=trim($verifyData);
        $code=0;
        $msg="";
        if (empty($account)|| empty($verifyData)){
            $code=-2;
//             $msg = ReturnHandler::responseObj(30);
        }
        else{
            $query = array(
                'account' => $account,
                'verifyData' => $verifyData,
                'expireTime' => $expireTime,
                'type' => 3,
                'IP' => '',
                'device' => 2,
            );
            $result = ApiHandler::callApi('checkVerifyData', $query);
            if(!isset($result['code']) || $result['code'] != 1){
                $code=-1;
//                 $msg = ReturnHandler::responseObj(999, null, $desc);
            }
            else{
                if(time()>$expireTime){
                    $code=-1;
                    $msg="VerifyData is Expired";
                }
                else{
                    $code=0;
                    $msg='';
                }
            }
        }
        $retObj = array(
            'code' => $code,
            'desc' => $msg,
        );
        return $retObj;
    }
    
    public static function checkTempToken($tempToken,$expireTime,$account){
        $account = trim($account);
        $tempToken=trim($tempToken);
        $code=0;
        $msg="";
        if (empty($account)|| empty($tempToken)){
            $code=-2;
//             $msg = ReturnHandler::responseObj(31);
        }
        else{
            $query = array(
                'account' => $account,
                'tempToken' => $tempToken,
                'expireTime' => $expireTime,
                'type' => 3,
                'IP' => '',
                'device' => 2,
            );
            $result = ApiHandler::callApi('checkTempToken', $query);
            if(!isset($result['code']) || $result['code'] != 1){
                $code=-1;
                $desc = isset($result['desc']) ? $result['desc'] : '';
//                 $msg = ReturnHandler::responseObj(999, null, $desc);
            }
            else{
                if(time()>$expireTime){
                    $code=-1;
                    $msg="TempToken is Expired";
                }
                else{
                    $code=0;
                    $msg='';
                }
            }
        }
        $retObj = array(
            'code' => $code,
            'desc' => $msg,
        );
        return $retObj;
    }
    
    public static function login($account = '', $password = '',$verifyCode)
    {
        $account = trim($account);
        $password = trim($password);
        $verifyCode = trim($verifyCode);
        $code=0;
        $msg='';
        $data=null;
        if(empty($account) || empty($password)){
            $code=-2;
//             $msg= ReturnHandler::responseObj(32);
        }
        else{
            $query = array(
                'account' => $account,
                'password' => $password,
                'verifyCode' => $verifyCode,
                'type' => 3,
                'IP' => '',
                'device' => 2,
            );
            
            $result = ApiHandler::callApi('login', $query);
            
            if(!isset($result['code']) || $result['code'] != 1){
                $code=-1;
                $desc = isset($result['desc']) ? $result['desc'] : '';
                $msg = Json::encode($result);
            }
            else{
                $role=$result['userInfo']['role'];
                if ($role>-1){
                    $admin=$result['userInfo']['account'];
                }
                else{
                    $admin='';
                }
                $session = array(
                    'verifyData' =>  $result['verifyData']['token'],
                    'token' =>  $result['tempToken']['token'],
                    'guid' => $result['userInfo']['guid'],
                    'account' => $result['userInfo']['account'],
                    'checkCode' => $result['userInfo']['checkCode'],
                    'sid' => $result['userInfo']['sid'],
                    'name' => $result['userInfo']['name'],
                    'weekNo' => $result['weekNo'],
                    'weekNewest' => $result['weekNo'],
                    //                     'platformList' => Json::encode($result['platformList']),
                    'platformList' => "",
                    'accountLevel' => $result['userInfo']['accountLevel'],
                    'weekNoTag' => false,
                    'admin' => $admin,
                    'role' => $role,
		    'eRate' => $result['eRate'],
                    'login' => true
                );
                
                Session::save($session);
                $code=0;
                $msg='';
                $msg = Json::encode($result);
                $data=array();
            }
        }
        $retObj = array(
            'code' => $code,
            'desc' => $msg,
            'data' => $data,
        );
        return $retObj;
    }
    
    public static function getUser($guid,$account)
    {
        $query = array('guid' => $guid,'account' => $account);
        $result = ApiHandler::callApi('getUser', $query);
        return $result;
    }
    
    public static function isLogin()
    {
        $isLogin = FALSE;
        $guid = Session::get('guid');
        if($guid){
            //token������
            $account = Session::get('account');
            $result = self::getUser($guid,$account);
            if($result['code'] == 1){
                $isLogin = TRUE;
            }
        }  
        return $isLogin;
    }
    
    public static function isAdmin(){
        $isLogin = -1;
        $admin = Session::get('admin');
        $account = Session::get('account');
        if($admin==$account){
            $role = Session::get('role');
            $isLogin=$role;
        }
        return $isLogin;
    }
    public static function logout(){
        if (Auth::isLogin()){
            $guid = Session::get('guid');
            //call logout API
            Session::deleteAll();
        }
    }
    public static function changepwd($account = '', $oldpassword = '',$newpassword='')
    {
        $account = trim($account);
        $oldpassword = trim($oldpassword);
        $newpassword = trim($newpassword);
        $code=0;
        $msg='';
        $data=null;
        if(empty($account) || empty($newpassword) || empty($oldpassword)){
            $code=-2;
            //             $msg= ReturnHandler::responseObj(32);
        }
        else{
            $query = array(
                'account' => $account,
                'oldpassword' => $oldpassword,
                'newpassword' => $newpassword,
                'type' => 3,
                'IP' => '',
                'device' => 2,
            );
            
            $result = ApiHandler::callApi('changePwd', $query);
            
            if(!isset($result['code']) || $result['code'] != 1){
                $code=-1;
                $desc = isset($result['desc']) ? $result['desc'] : '';
                $msg = Json::encode($result);
                //                 $msg =ReturnHandler::responseObj(999, null, $desc);
            }
            else{
                $code=0;
                $msg='';
                $msg = Json::encode($result);
                $data=array();
            }
        }
        $retObj = array(
            'code' => $code,
            'desc' => $msg,
            'data' => $data,
        );
        return $retObj;
    }
    
    public static function getPersonalData($account){
        $query = array(
            'account' => $account,
        );
        
        $result = ApiHandler::callApi('getPersonalData', $query);
        
        if(!isset($result['code']) || $result['code'] != 1){
            $code=-1;
            $desc = isset($result['desc']) ? $result['desc'] : '';
            $msg = Json::encode($result);
            //                 $msg =ReturnHandler::responseObj(999, null, $desc);
        }
        else{
            $code=0;
            $msg=$result;
            //$msg = Json::encode($result);
            $data=array();
        }
        $retObj = array(
            'code' => $code,
            'desc' => $msg,
            //             'data' => $data,
        );
        return $retObj;
    }
    
    public static function forgetPWD($account, $idWay,$name,$email)
    {
        $query = array(
            'account' => $account,
            'idWay' => $idWay,
            'name' => $name,
            'email' => $email,
        );
        
        $result = ApiHandler::callApi('forgetPWD', $query);
        
        if(!isset($result['code']) || $result['code'] != 1){
            $code=-1;
            $desc = isset($result['desc']) ? $result['desc'] : '';
            $msg = Json::encode($result);
            //                 $msg =ReturnHandler::responseObj(999, null, $desc);
        }
        else{
            $code=0;
            $msg='';
            //$msg = Json::encode($result);
            $msg='網站:'.WEB_SITE_URL.','.$result['desc'];
            $data=array();
        }
        $retObj = array(
            'code' => $code,
            'desc' => $msg,
//             'data' => $data,
        );
        return $retObj;
    }
    
    public static function verify($account = '', $password = '',$verifyCode)
    {
        $account = trim($account);
        $password = trim($password);
        $verifyCode = trim($verifyCode);
        $code=0;
        $msg='';
        $data=null;
        if(empty($account) || empty($password)){
            $code=-2;
            //             $msg= ReturnHandler::responseObj(32);
        }
        else{
            $query = array(
                'account' => $account,
                'password' => $password,
                'verifyCode' => $verifyCode,
                'type' => 3,
                'IP' => '',
                'device' => 2,
            );
            
            $result = ApiHandler::callApi('verify', $query);
            
            if(!isset($result['code']) || $result['code'] != 1){
                $code=-1;
                $desc = isset($result['desc']) ? $result['desc'] : '';
                $msg = Json::encode($result);
            }
            else{
                $role=$result['userInfo']['role'];
                if ($role>-1){
                    $admin=$result['userInfo']['account'];
                }
                else{
                    $admin='';
                }
                $session = array(
                    'verifyData' =>  $result['verifyData']['token'],
                    'token' =>  $result['tempToken']['token'],
                    'guid' => $result['userInfo']['guid'],
                    'account' => $result['userInfo']['account'],
                    'checkCode' => $result['userInfo']['checkCode'],
                    'sid' => $result['userInfo']['sid'],
                    'name' => $result['userInfo']['name'],
                    'weekNo' => $result['weekNo'],
                    'weekNewest' => $result['weekNo'],
                    //                     'platformList' => Json::encode($result['platformList']),
                    'platformList' => "",
                    'accountLevel' => $result['userInfo']['accountLevel'],
                    'weekNoTag' => false,
                    'admin' => $admin,
                    'role' => $role,
                    'login' => true
                );
                Session::save($session);
                $code=0;
                $msg='';
                $msg = Json::encode($result);
                $data=array();
            }
        }
        $retObj = array(
            'code' => $code,
            'desc' => $msg,
            'data' => $data,
        );
        return $retObj;
    }
    public static function setAdminList($arr){
        $object=array(
            'arr'=>$arr,
        );
        $result = ApiHandler::callApi('setAdminlist', $object);
        if(!isset($result['code']) || $result['code'] != 0){
            $code=1;
            //$desc = isset($result['desc']) ? $result['desc'] : '';
            //                 $msg =ReturnHandler::responseObj(999, null, $desc);
        }
        else{
            $code=0;
        }
        
        $retObj = array(
            'code' => $code,
        );
        return $retObj;
    }
    public static function getSunshipData($web,$td,$CargoNo){
        $object=array(
            "web"=>$web,
            "td"=>$td,
            "CargoNo"=>$CargoNo
        );
        $data='';
        $result = ApiHandler::callApi('getSunshipData', $object);
        if(!isset($result['code']) || $result['code'] != 0){
            $data=$result['data'];
        }
        return $data;
        
    }
    public static function getAdminlist(){
        $object=array();
        $data=null;
        $result = ApiHandler::callApi('getAdminlist', $object);
        if(!isset($result['code']) || $result['code'] != 0){
            $code=1;
            //$desc = isset($result['desc']) ? $result['desc'] : '';
            $msg = Json::encode($result);
            //                 $msg =ReturnHandler::responseObj(999, null, $desc);
        }
        else{
            $code=0;
            $msg='';
            $msg = Json::encode($result);
            $data=$result['data'];
        }
        
        $retObj = array(
            'code' => $code,
            'desc' => $msg,
            'data' => $data,
        );
        return $retObj;
    }
}
?>
