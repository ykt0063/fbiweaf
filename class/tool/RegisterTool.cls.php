<?php
namespace report\tool;

use report\base\ApiHandler;
use report\base\Json;
use report\user\Session;

class RegisterTool{
//     public static function register($reg,$bossId,$trueIntroNo){
//         $def= $reg['def'];
//         $val= $reg['val'];
//         $query = array(
//             'DEF' => $def,
//             'VAL' => $val,
//             'bossId' => $bossId,
//             'trueIntroNo'=>$trueIntroNo,
//         );
//         $result = ApiHandler::callApi('register', $query);
//         $code=0;
//         $msg='';
//         $data=null;
//         if(!isset($result['code']) || $result['code'] != 0){
//             $code=-1;
//             $msg=$result['desc'];
//             //                 $msg = ReturnHandler::responseObj(999, null, $desc);
//         }
//         else{
//             $code=0;
//             //$msg = Json::encode($result);
//             $session=array();
//             $session['tmpMBNO']=$result['data'];
//             $session['introNo']=$result['introNo'];
//             $session['orgI']=$result['orgI'];
//             $session['orgT']=$result['orgT'];
//             Session::save($session);
//             $msg="您的帳號是 '".$result['data']."' 請使用新帳號登入";
//             RegisterTool::OfficialRegistration();
//         }
//         $retObj = array(
//             'code' => $code,
//             'desc' => $msg,
//             'data' => $data,
//         );
//         return $retObj;
//     }

    public static function register($bossId,$mbName,$passwd,$trueIntroNo,$address1,$tel1,$mtel,$birth,$sex,$mRightTag,$privacyTag){
        $query = array(
            'mbName' => $mbName,
            'passwd' => $passwd,
            'bossId' => $bossId,
            'trueIntroNo'=>$trueIntroNo,
            'address1'=>$address1,
            'tel1'=>$tel1,
            'mtel'=>$mtel,
            'birth'=>$birth,
            'sex'=>$sex,
            'mRightTag'=>$mRightTag,
            'privacyTag'=>$privacyTag,
        );
        $result = ApiHandler::callApi('register', $query);
        $code=0;
        $msg='';
        $data=null;
        if(!isset($result['code']) || $result['code'] != 1){
            $code=-1;
            $msg=$result['desc'];
            //                 $msg = ReturnHandler::responseObj(999, null, $desc);
        }
        else{
            $code=1;
            //$msg = Json::encode($result);
            $session=array();
//            $session['tmpMBNO']=$result['data'];
//            $session['introNo']=$result['introNo'];
//            $session['orgI']=$result['orgI'];
//            $session['orgT']=$result['orgT'];
            Session::save($session);
//            $msg="您的帳號是 '".$result['data']."' 請使用新帳號登入";
            $result=RegisterTool::OfficialRegistration();
        }
        $retObj = array(
            'code' => $code,
            'desc' => $msg,
            'data' => $data,
        );
        return $retObj;
    }
    
    public static function checkStatus(){
        $tmpMBNO=Session::get('tmpMBNO');
        if (!empty($tmpMBNO)){
            return true;
        }
        return false;
    }
    public static function OfficialRegistration(){
        if (!empty(Session::get('tmpMBNO'))){
            $mbno=Session::get('tmpMBNO');
            $introNo=Session::get('introNo');
            $orgI=Session::get('orgI');
            $orgT=Session::get('orgT');
            $query = array(
                'mbno' => $mbno,
                'introNo' => $introNo,
                'orgI' => $orgI,
                'orgT' => $orgT,
            );
            $result = ApiHandler::callApi('OfficialRegister', $query);
            $code=0;
            if(!isset($result['code']) || $result['code'] != 0){
                $code=-1;
                //                 $msg = ReturnHandler::responseObj(999, null, $desc);
            }
            else{
                $code=0;
                //$msg = Json::encode($result);
                $obj=array(
                    'account'=>$mbno,
                );
                SESSION::save($obj);
                
//                 $role=$result['userInfo']['role'];
//                 if ($role>-1){
//                     $admin=$result['userInfo']['account'];
//                 }
//                 else{
//                     $admin='';
//                 }
//                 $session = array(
//                     'verifyData' =>  $result['verifyData']['token'],
//                     'token' =>  $result['tempToken']['token'],
//                     'guid' => $result['userInfo']['guid'],
//                     'account' => $result['userInfo']['account'],
//                     'checkCode' => $result['userInfo']['checkCode'],
//                     'sid' => $result['userInfo']['sid'],
//                     'name' => $result['userInfo']['name'],
//                     'weekNo' => $result['weekNo'],
//                     'weekNewest' => $result['weekNo'],
//                     //                     'platformList' => Json::encode($result['platformList']),
//                     'platformList' => "",
//                     'accountLevel' => $result['userInfo']['accountLevel'],
//                     'weekNoTag' => false,
//                     'admin' => $admin,
//                     'role' => $role,
//                     'login' => true
//                 );
//                 Session::save($session);
            }
            $retObj = array(
                'code' => $code,
            );
            return $retObj;
        }
    }
    public static function getRegistData($tag,$mbno){
        //$tag==1 ->Official Member
        $query = array(
            'mbno' => $mbno,
            'tag' => $tag,
        );
        $result = ApiHandler::callApi('getRegistData', $query);
        $code=0;
        $msg='';
        $data=null;
        if(!isset($result['code']) || $result['code'] != 0){
            $code=-1;
            $data=null;
            //                 $msg = ReturnHandler::responseObj(999, null, $desc);
        }
        else{
            $code=0;
            $name="";
            $tel="";
            $mtel="";
            $addr="";
            $data=$result['data'];
            foreach( $data as $key => $value ){
                if (is_null($value)){
                    $value='';
                }
                $name=$value['mbname'];
                $tel=$value['tel'];
                $mtel=$value['mtel'];
                $addr=$value['addr'];
                //                 switch ($key){
                //                     case "mbname":
                //                         $name=$value;
                //                         break;
                //                     case "tel":
                //                         $tel=$value;
                //                         break;
                //                     case "mtel":
                //                         $mtel=$value;
                //                         break;
                //                     case "addr":
                //                         $addr=$value;
                //                         break;
                //                 }
            }
            $data=array(
                'name'=> $name,
                'tel'=> $tel,
                'mtel'=>$mtel,
                'addr'=>$addr,
            );
        }
        $retObj = array(
            'code' => $code,
            'data' => $data,
        );
        return $retObj;
    }
}