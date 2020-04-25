<?php
namespace api\regist;

use core\main\Main;
use core\response\cReturnHandler;

class Regist {
    public function __construct(){
        
    }
    public static function searchButton($object){
        $choice=$object['choice'];
        $p1=$object['parameter1'];
        $p2=$object['parameter2'];
        $sqlStr="call searchButton($choice,'$p1','$p2')";
        $result = Main::$mysql->sql_query($sqlStr);
        $code=1;
        if( count($result)>0 ){
            $code=0;
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$result;
        return cReturnHandler::responseObj(1,  $obj);
    }
//     public static function register($object){
//         $def= $object['DEF'];
//         $val= $object['VAL'];
//         $bossId=$object['bossId'];
//         $trueIntroNo=$object['trueIntroNo'];
//         $sqlStr="call getTMPCOUNTER(\"".$bossId."\",\"".$trueIntroNo."\")";
//         $result = Main::$mysql->sql_query($sqlStr);
//         $ct=0;
//         $obj=array();
//         if( $result ){
//             $row = Main::$mysql->sql_fetch_array($result);
//             $ct = $row['CT'];
//             $iNum= $row['iNum'];

//             if ($iNum>0){
//                 if ($ct==0){
//                     $insertString = "INSERT INTO tmpmbst (MB_NO,".$def.") VALUES('".$bossId."',".$val.")";
// //                 $ct=$ct+1;
// //                 $tmpMBNO=$bossId."-".sprintf("%'.02d", $ct);
// //                 $insertString = "INSERT INTO tmpmbst (MB_NO,".$def.") VALUES('".$tmpMBNO."',".$val.")";
//                 //             $insertString = "INSERT INTO tmpmbst ('MB_NO',".$def;
//                 //             $insertString = $insertString .") VALUES('".$tmpMBNO;
//                 //             $insertString = $insertString ."',";
//                 //             $sqlStr1 = $insertString .$val.")";
//                     $result2 = Main::$mysql->sql_query($insertString);
//                     if ($result2){
//                         $queryStr="call getTmpRegistData('".$bossId."')";
//                         $result3 = Main::$mysql->sql_query($queryStr);
//                         $row = Main::$mysql->sql_fetch_array($result3);
//                         $code=0;
//                         $introNo=$row['TRUE_INTRO_NO'];
//                         $orgI=$row['ORG_I'];
//                         $orgT=$row['ORG_T'];
//                         $obj['code']=$code;
//                         $obj['introNo']=$introNo;
//                         $obj['data']=$tmpMBNO;
//                         $obj['orgI']=$orgI;
//                         $obj['orgT']=$orgT;
//                     }
//                     else{
//                         $obj['code']=-2;
//                         $obj['desc']="can not insert data into tmpmbst";
//                     }
//                 }
//             }
//             else{
//                 $obj['code']=-3;
//                 $obj['desc']="推薦人不存在";
//             }
//         }
//         else{
//             $obj['code']=-1;
//         }
//         return cReturnHandler::responseObj(1,  $obj);
//     }

    public static function register($object){
        $mbName= $object['mbName'];
        $passwd= $object['passwd'];
        $bossId=$object['bossId'];
        $trueIntroNo=$object['trueIntroNo'];
        $address1=$object['address1'];
        $tel1=$object['tel1'];
        $mtel=$object['mtel'];
        $birth=$object['birth'];
        $sex=$object['sex'];
        $privacyTag=$object['privacyTag'];
        $mRightTag=$object['mRightTag'];
        $sqlStr="call smsRegist('".$bossId."','".$mbName."','".$passwd."','".$trueIntroNo."','".$address1."','".$tel1."','".$mtel."','".$birth."','".$sex."','".$mRightTag."','".$privacyTag."')";
        // echo "<!-- sqlStr=$sqlStr -->";
        $result = Main::$mysql->sql_query($sqlStr);
        $ct=0;
        $obj=array();
        $obj['desc']='';
        if( $result ){
            $row = Main::$mysql->sql_fetch_array($result);
            $res = $row['res'];
            $obj['code']=$res;
        }
        else{
            $obj['code']=-1;//無法建立連線
        }
        return cReturnHandler::responseObj(1,  $obj);
    }
    
    public static function OfficialRegister($object){
        $mbno=$object['mbno'];
        $introNo=$object['introNo'];
        $orgI=$object['orgI'];
        $orgT=$object['orgT'];
        $sqlStr="call changeToRealAccount('$mbno')";
        $result = Main::$mysql->sql_query($sqlStr);
        $code=1;
        $obj=array();
        if ($result){
            $code=0;
        }
        $obj['code']=$code;
        return cReturnHandler::responseObj(1,  $obj);
    }
    public static function getRegistData($object){
        $tag=$object['tag'];
        $mbno=$object['mbno'];
        $sqlStr="call getRegistData($tag,'$mbno')";
        $result = Main::$mysql->sql_query($sqlStr);
        $code=1;
        if(is_object($result) && (Main::$mysql->sql_num_rows($result)>0)){
            $code=0;
        }
        $obj=array();
        $obj['code']=$code;
        $obj['data']=$result;
        return cReturnHandler::responseObj(1,  $obj);
    }
}