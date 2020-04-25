<?php

namespace api\organization;

use core\main\Main;
use core\response\cReturnHandler;

class Organization {
    public function __construct(){
        
    }
    
    public static function sunLine($object){
        $account = $object['account'];
        $weekNo = $object['weekNo'];
//         $sqlStr="call getMemberTree(1,'$account','')";
        $sqlStr="call getMemberTree2(1,'".$account."','','".$weekNo."')";
//         $sqlStr="select a.MB_NO,a.MB_NAME,a.GRADE_CLASS,a.GRADE_NAME,a.INTRO_NO,a.LEVEL_NO_I,a.LEVEL_NO_T,";
//         $sqlStr=$sqlStr."a.ORGSEQ_NO_I,a.ORGSEQ_NO_T,b.MB_NAME as INTRO_NAME from ERP.mbst a ";
//         $sqlStr=$sqlStr."left join kagana.mbst b on a.INTRO_NO=b.MB_NO where a.ORGSEQ_NO_T like (select concat(ORGSEQ_NO_T,'%') from mbst where MB_NO='$account')";
        $result = Main::$mysql->sql_query($sqlStr);
        $retObj = array();
        if( $result ){
            $retObj['columnName']=array('MB_NO','MB_NAME','GRADE_CLASS','GRADE_NAME','INTRO_NO','LEVEL_NO','LEVEL_NO_I','LEVEL_NO_T','ORGSEQ_NO_I','ORGSEQ_NO_T','INTRO_NAME','PG_DATE','MB_STATUS','PV','A_LINE_SUB','B_LINE_SUB','C_LINE_SUB');
            while( $row = Main::$mysql->sql_fetch_array($result))
            {
                $retObj[$row['ORGSEQ_NO_T']]=$row;
            }
        }
        return cReturnHandler::responseObj(1,  $retObj);
        
    }
    
    public static function dualSystem($object){
        $weekNo = $object['weekNo'];
        if (isset($object['orgNO'])){
            $orgNO = $object['orgNO'];
//             $sqlStr="call getMemberTree(2,'','$orgNO')";
            $sqlStr="call getMemberTree2(2,'','$orgNO','$weekNo')";
            //$sqlStr="call getMemberTree1(2,'','$orgNO','201804','201803')";
            
//             $sqlStr="select a.MB_NO,a.MB_NAME,a.GRADE_CLASS,a.GRADE_NAME,a.INTRO_NO,a.LEVEL_NO_I,a.LEVEL_NO_T,";
//             $sqlStr=$sqlStr."a.ORGSEQ_NO_I,a.ORGSEQ_NO_T,b.MB_NAME as INTRO_NAME from ERP.mbst a ";
//             $sqlStr=$sqlStr."left join kagana.mbst b on a.INTRO_NO=b.MB_NO where a.ORGSEQ_NO_I like '$orgNO%'";
        }else{
            $account = $object['account'];
//            $sqlStr="call getMemberTree(3,'$account','')";
            $sqlStr="call getMemberTree2(3,'$account','','$weekNo')";
            //$sqlStr="call getMemberTree1(3,'$account','','201804','201803')";
//             $sqlStr="select a.MB_NO,a.MB_NAME,a.GRADE_CLASS,a.GRADE_NAME,a.INTRO_NO,a.LEVEL_NO_I,a.LEVEL_NO_T,";
//             $sqlStr=$sqlStr."a.ORGSEQ_NO_I,a.ORGSEQ_NO_T,b.MB_NAME as INTRO_NAME from ERP.mbst a ";
//             $sqlStr=$sqlStr."left join ERP.mbst b on a.INTRO_NO=b.MB_NO where a.ORGSEQ_NO_I like (select concat(ORGSEQ_NO_I,'%') from mbst where MB_NO='$account')";
        }        
        $result = Main::$mysql->sql_query($sqlStr);
        $retObj = array();
        if( $result ){
            $retObj['columnName']=array('MB_NO','MB_NAME','GRADE_CLASS','GRADE_NAME','INTRO_NO','LEVEL_NO','LEVEL_NO_I','LEVEL_NO_I','ORGSEQ_NO_I','ORGSEQ_NO_T','INTRO_NAME','PV','A_LINE_SUB','B_LINE_SUB','C_LINE_SUB');
            while( $row = Main::$mysql->sql_fetch_array($result))
            {
                $retObj[$row['ORGSEQ_NO_I']]=$row;
            }
        }
        return cReturnHandler::responseObj(1,  $retObj);        
    }
    
    public static function directMember($object){
        $account = $object['account'];
        $sqlStr="SELECT MB_NO,MB_NAME,TEL1,LEVEL_NO,GRADE_NAME FROM MBST WHERE TRUE_INTRO_NO='".$account."';";
        $result = Main::$mysql->sql_query($sqlstr);
        $retObj = array('list' => array(),'columnName');
        if( $result ){
            $retObj['list']['comumnName']=array('MB_NO','MB_NAME','TEL1','LEVEL_NO','GRADE_NAME');
            while( $row = Main::$mysql->sql_fetch_array($result))
               {
                $retObj['list'][$row['accont']] = $row;
               }
           }
        return cReturnHandler::responseObj(1,  $retobj);
     }
}