<?php
namespace report\organization;

use report\base\ApiHandler;
use report\base\NodeData;
use report\tool\SearchTrinaryTree;
use report\tool\SearchMSubTree;
use report\user\Session;

class Personal{
    public static function getRedSunHistoryData($bDate,$eDate){
        $object = array();
        $object['bdate']=$bDate;
        $object['edate']=$eDate;
        $result = ApiHandler::callApi('getRedSunHistoryData', $object);
        $code = $result['code'];
        $object=array();
        $object['code']=$code;
        $data=array();
        if ($code==1){
            $data=$result['data'];
        }
        $object['data']=$data;
        return $object;
    }
    public static function getEXList($account,$bdate,$edate){
        $object = array();
        $object['account']=$account;
        $object['bdate']=$bdate;
        $object['edate']=$edate;
        $result = ApiHandler::callApi('getEXLists', $object);
        $code = $result['code'];
        $object=array();
        $object['code']=$code;
        $data=array();
        if ($code==1){
            $data=$result['data'];
        }
        $object['data']=$data;
        return $object;
        
    }
    public static function GetWeekNoList($weekNO){
        $str='';
        $object = array();
        //$object['weekNo']=$weekNo;
        $result = ApiHandler::callApi('getWeekNoList', $object);
        if ($result['code']==0){
            //         $listA = $result['data'];
            $data=Personal::getWeekNoListData($result['data'],$weekNO);
            $str=$data;
        }
        return $str;
    }
    
    public static function GetBonusReport($account,$weekNo){
        $obj=NULL;
        $object = array();
        $object['account']=$account;
        $object['weekNo']=$weekNo;
        $result = ApiHandler::callApi('getBonusData', $object);
        if ($result['code']==0){
            //         $listA = $result['data'];
            $data=$result['data'];
            $obj=Personal::getBonusReportData($data,$weekNo);
        }
        return $obj;
    }
    public static function GetBonusReport0($account,$weekNo,$choice){
        $strList='';
        $object = array();
        $object['account']=$account;
        $object['weekNo']=$weekNo;
        $result = ApiHandler::callApi('getBonusData', $object);
        if ($result['code']==0){
            $data=$result['data'];
            $strlist=Personal::getWeekNoListData($data,$weekNo,$choice);
        }
        return $strlist;
    }
    
    public static function sunLine($account,$weekNo=''){
        $object = array();
        $object['account']=$account;
        $object['weekNo']=$weekNo;
        $result = ApiHandler::callApi('sunLine', $object);
        $data = array();
        if(!isset($result['code']) || $result['code'] != 1){
            $code=-1;
            $data=null;
            $columnName=null;
        }
        else{
            $code=0;
//             foreach( $result as $key => $value )
//             {
//                 if(($key!='code')&&($key!='desc')){
//                     if ($key=='columnName'){
//                         $columnName=$value;
//                     }
//                     else{
//                         $data[$key]=$value;
//                     }
//                 }
                
//             }
            $tmpArray = Personal::gettmpData($result);
            if (count($tmpArray)>0){
                $columnName=$tmpArray[0];
                $data=$tmpArray[1];
                //             $data = $result['list'];
                $tmpData = Personal::prepareMSort($data,$columnName);
                if ($tmpData!=null){
                    $data = $tmpData['data'];
                    $columnName= $tmpData['columnName'];
                }
            }
            else{
                $code=-1;
                $data=null;
                $columnName=null;
            }
        }
        $retObj = array(
            'code' => $code,
            'data' => $data,
            'columnName' => $columnName,
        );
        return $retObj;        
    }

    public static function gettmpData($result){
        $tmpArray = array();
        $data=array();
        $tag=false;
        foreach( $result as $key => $value )
        {
            if(($key!='code')&&($key!='desc')){
                if ($key=='columnName'){
                    $columnName=$value;
                    $tag=true; 
                }
                else{
                    $data[$key]=$value;
                }
            }              
        }
        if ($tag){
            $tmpArray[0]=$columnName;
            $tmpArray[1]=$data;
        }
        return $tmpArray;        
    }
    public static function dualSystem($account,$weekNo=''){
        return Personal::dualSystems($account, 1,'',-1,$weekNo);
    }
    public static function dualSystemLevel($account,$orgNO='',$accountLevel=-1,$weekNo=''){
        return Personal::dualSystems($account,2,$orgNO,$accountLevel,$weekNo);
    }
    public static function dualSystems($account,$tag,$orgNO='',$accountLevel=-1,$weekNo=''){
        $object = array();
        if ($orgNO!=''){
            $object['orgNO']=$orgNO;
        }else{
            $object['account']=$account;            
        }
        $object['weekNo']=$weekNo;
        $result = ApiHandler::callApi('dualSystem', $object);
        $data = array();
        if(!isset($result['code']) || $result['code'] != 1){
            $code=-1;
            $data=null;
            $columnName=null;
        }
        else{
            $code=0;
            $obj = Personal::getData($result);
            $columnName = $obj['columnName'];
            $data = $obj['data'];
//             $data = $result['list'];
            //$tmpData = Personal::prepareBinarySort($data,$columnName,$tag,$accountLevel);
            $tmpData = Personal::prepareTrinarySort($data,$columnName,$tag,$accountLevel);
            if ($tmpData!=null){
                $data = $tmpData['data'];
                $columnName= $tmpData['columnName'];
            }
        }
        $retObj = array(
            'code' => $code,
            'data' => $data,
            'columnName' => $columnName,
        );
        return $retObj;
    }

    private static function getData($result){
        $data=array();
        foreach( $result as $key => $value )
        {
            if(($key!='code')&&($key!='desc')){
                if ($key=='columnName'){
                    $columnName=$value;
                }
                else{
                    $data[$key]=$value;
                }
            }
            
        }
        $obj=array();
        $obj['data']=$data;
        $obj['columnName']=$columnName;
        return $obj;
    }
    private static function createBtree($data,$columnName){
        $bTree = new SearchTrinaryTree();
        $tmpLevel=1000;
        foreach ($data as $row){
            $MB_NO=$row['MB_NO'];
            $MB_NAME=$row['MB_NAME'];
            $GRADE_CLASS=$row['GRADE_CLASS'];
            $GRADE_NAME=$row['GRADE_NAME'];
            $INTRO_NO=$row['INTRO_NO'];
            $LEVEL_NO_I=$row['LEVEL_NO_I'];
            $LEVEL_NO_T=$row['LEVEL_NO_T'];
            $ORGSEQ_NO_I=$row['ORGSEQ_NO_I'];
            $ORGSEQ_NO_T=$row['ORGSEQ_NO_T'];
            $INTRO_NAME=$row['INTRO_NAME'];
            $PG_DATE=$row['PG_DATE'];
            $MB_STATUS=$row['MB_STATUS'];
            $PV=$row['PV'];
            $A_LINE_SUB=$row['A_LINE_SUB'];
            $B_LINE_SUB=$row['B_LINE_SUB'];
            $C_LINE_SUB=$row['C_LINE_SUB'];
            $nodeData = new NodeData($MB_NO, $MB_NAME, $GRADE_CLASS, $GRADE_NAME, $INTRO_NO, $LEVEL_NO_I, $LEVEL_NO_T, $ORGSEQ_NO_I, $ORGSEQ_NO_T, $INTRO_NAME,$PG_DATE,$MB_STATUS,$PV,$A_LINE_SUB,$B_LINE_SUB,$C_LINE_SUB);
            $bTree->create($ORGSEQ_NO_I, $nodeData);
            if ($LEVEL_NO_I<$tmpLevel){
                $tmpLevel=$LEVEL_NO_I;
            }
        }
        $obj=array();
        $obj['bTree']=$bTree;
        $obj['level']=$tmpLevel;
        return $obj;
    }
    
    private static function prepareBinarySort($data,$columnName,$tag,$accountLevel){
        $obj = Personal::createBtree($data,$columnName);
        $bTree=$obj['bTree'];
        $tmpLevel=$obj['level'];
//        $bTree->setAccountLevel($tmpLevel);
        $bTree->setAccountLevel($accountLevel);
        $newData=$bTree->traverse('preorder',$tag);
        $obj=array();
        $obj['data']=$newData;
        $obj['columnName']=$columnName;
        return $obj;
    }
    private static function prepareTrinarySort($data,$columnName,$tag,$accountLevel){
        $obj = Personal::createBtree($data,$columnName);
        $bTree=$obj['bTree'];
        $tmpLevel=$obj['level'];
        //        $bTree->setAccountLevel($tmpLevel);
        $bTree->setAccountLevel($accountLevel);
        $newData=$bTree->traverse('preorder',$tag);
        $obj=array();
        $obj['data']=$newData;
        $obj['columnName']=$columnName;
        return $obj;
    }
    
    public static function directMember($account){
        $object = array();
        $object['account']=account;
        $result = ApiHandler::callApi('directMember', $query);
        $data = array();
        if(!isset($result['code']) || $result['code'] != 1){
            $code=-1;
            $data=null;
            $columnName=null;
          }
        else{
            $code=0;
            foreach( $result as $key => $value )
            {
                if(($key!='code')&&($key!='msg')){
                    if ($key=='columnName'){
                        $columnName=$value;
                    }
                    else{
                        $data[$key]=value;
                    }
                }
                
            }
//             $data = $result['list'];
         }
       $retObj = array(
        'code' => $code,
        'data' => $data,
        'columnName' => $columnName,
         );
       return $retObj;
     }
     private static function prepareMSort($data,$columnName){
         $mTree = new SearchMSubTree();
         foreach ($data as $row){
             $MB_NO=$row['MB_NO'];
             $MB_NAME=$row['MB_NAME'];
             $GRADE_CLASS=$row['GRADE_CLASS'];
             $GRADE_NAME=$row['GRADE_NAME'];
             $INTRO_NO=$row['INTRO_NO'];
             $LEVEL_NO_I=$row['LEVEL_NO_I'];
             $LEVEL_NO_T=$row['LEVEL_NO_T'];
             $ORGSEQ_NO_I=$row['ORGSEQ_NO_I'];
             $ORGSEQ_NO_T=$row['ORGSEQ_NO_T'];
             $INTRO_NAME=$row['INTRO_NAME'];
             $PG_DATE=$row['PG_DATE'];
             $MB_STATUS=$row['MB_STATUS'];
             $PV=$row['PV'];
             $A_LINE_SUB=$row['A_LINE_SUB'];
             $B_LINE_SUB=$row['B_LINE_SUB'];
             $C_LINE_SUB=$row['C_LINE_SUB'];
             $nodeData = new NodeData($MB_NO, $MB_NAME, $GRADE_CLASS, $GRADE_NAME, $INTRO_NO, $LEVEL_NO_I, $LEVEL_NO_T, $ORGSEQ_NO_I, $ORGSEQ_NO_T, $INTRO_NAME,$PG_DATE,$MB_STATUS,$PV,$A_LINE_SUB,$B_LINE_SUB,$C_LINE_SUB);
             $mTree->create($ORGSEQ_NO_T, $nodeData);
         }
         $newData=$mTree->traverse('preorder');
         $obj=array(
             'data'=>$newData,
             'columnName'=>$columnName,
         );
         return $obj;
     }
     private static function getBonusReportData($data,$weekNO){
         $strlist=Personal::getWeekNoListData($data,$weekNO);
         $str=Personal::getBonusReport1($data);
         $str=$str.Personal::getBonusReport2($data);
         $str=$str.Personal::getBonusReport3($data);
         $str=$str.Personal::getBonusReport4($data);
         $str=$str.Personal::getBonusReport5($data);
         $str=$str.Personal::getBonusReport6($data);
         $str=$str.Personal::getBonusReport7($data);
         $str=$str.Personal::getBonusReport8($data);
         $str=$str.Personal::getBonusReport9($data);
         $str=$str.Personal::getBonusReport10($data);
         $obj=array();
         $obj[]=$strlist;
         $obj[]=$str;
         return $obj;
     }
     private static function getBonusReport1($data){
         $row=$data[1];
         $rowData=$row[0];
         $mbNO=$rowData[0];
         $mbName=$rowData[1];
         $weekNo=$rowData[2];
         $abMoney=$rowData[3];
         $levelMoney=$rowData[4];
         $orgMoney=$rowData[5];
         $cMoney=$rowData[6];
         $subtotal=$rowData[7];
         $tax=$rowData[8];
         $compTax=$rowData[9];
         $adjustMoney=$rowData[10];
         $nhiMoney=$rowData[11];
         $givemoney=$rowData[12];
         $remark=$rowData[13];
         $str="<div class=\"table-responsive\"><table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" style=\"font-family:標楷體;\" bordercolor=\"#BFCBF9\">";
         $str=$str."<tr><td height=\"23\" bgcolor=\"#0066CC\" colspan=\"5\">&nbsp;</td></tr>";
         $str=$str."<tr><td width=\"20%\">會員編號：$mbNO</td><td colspan=\"4\">$mbName</td></tr>";
         $str=$str."<tr><td width=\"20%\">對碰獎金:$abMoney</td><td>層碰獎金：$levelMoney</td><td>重消獎金：$orgMoney</td><td>重消對等：$cMoney</td><td>獎金合計：$subtotal</td></tr>";
         $str=$str."<tr><td width=\"20%\">應扣稅額：$tax</td><td>發票稅額：$compTax</td><td>獎金調整：$adjustMoney</td><td>二代健保：$nhiMoney</td><td>給付金額：$givemoney</td></tr>";
         $str=$str."<tr><td width=\"20%\" colspan=\"5\">備註：$remark</td></tr>";
//          $str=$str."<tr><td height=\"23\" bgcolor=\"#85E3F8\" colspan=\"5\">&nbsp;</td></tr>";
         $str=$str."</table></div>";
         return $str;
     }
     private static function getBonusReport2($data){
         $row=$data[2];
         $str="";
         if (count($row)>0){
             $str="<br><div class=\"table-responsive\"><table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\"  style=\"font-family:標楷體;\">";
             $str=$str."<tr bgcolor=\"#0066CC\"><td colspan=\"5\"><font color=\"#FFFFFF\" face=\"標楷體\">下線新增業績</font></td></tr> ";
             $str=$str."<tr id=\"header\" align=\"center\" bgcolor=\"#85E3F8\"><td width=\"5%\">層</td><td width=\"30%\">會員</td><td width=\"35%\"><<<業績明細>>></td><td width=\"15%\">業績小計</td><td width=\"15%\">備註</td></tr>";
             for ($i=0;$i<count($row);$i++){
                 $rowData=$row[$i];
                 $levelNO=$rowData[0];
                 $underMB=$rowData[1];
                 $details=$rowData[2];
                 $subtotal=$rowData[3];
                 $ps=$rowData[4];
                 $str=$str."<tr align=\"center\"><td>$levelNO</td><td>$underMB</td><td>$details</td><td>$subtotal</td><td>$ps</td></tr>";
             }
             $str=$str."</table></div>";
         }
         return $str;
     }
     private static function getBonusReport3($data){
         $row=$data[3];
         $str="";
         if (count($row)>0){
             $str="<br><div class=\"table-responsive\"><table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" style=\"font-family:標楷體;\">";
             $str=$str."<tr bgcolor=\"#0066CC\"><td colspan=\"5\"><font color=\"#FFFFFF\" face=\"標楷體\">對碰業績明細</font></td></tr> ";             
             $str=$str."<tr id=\"header\" align=\"center\" bgcolor=\"#85E3F8\"><td width=\"5%\"></td><td width=\"30%\">日期</td><td width=\"35%\"><<<業績明細>>></td><td width=\"15%\">業績小計</td><td width=\"15%\">備註</td></tr>";
             for ($i=0;$i<count($row);$i++){
                 $rowData=$row[$i];
                 $levelNO=$rowData[0];
                 $underMB=$rowData[1];
                 $details=$rowData[2];
                 $subtotal=$rowData[3];
                 $ps=$rowData[4];
                 $str=$str."<tr align=\"center\"><td></td><td>$underMB</td><td>$details</td><td>$subtotal</td><td>$ps</td></tr>";
             }
             $str=$str."</table></div>";
         }
         return $str;
     }
     private static function getBonusReport4($data){
         $row=$data[4];
         $str="";
         if (count($row)>0){
             $str="<br><div class=\"table-responsive\"><table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" style=\"font-family:標楷體;\">";
             $str=$str."<tr bgcolor=\"#0066CC\"><td colspan=\"5\"><font color=\"#FFFFFF\" face=\"標楷體\">層碰業績明細</font></td></tr> ";
             $str=$str."<tr id=\"header\" align=\"center\" bgcolor=\"#85E3F8\"><td width=\"5%\"></td><td width=\"30%\">日期</td><td width=\"35%\"><<<業績明細>>></td><td width=\"15%\">業績小計</td><td width=\"15%\">備註</td></tr>";
             for ($i=0;$i<count($row);$i++){
                 $rowData=$row[$i];
                 $levelNO=$rowData[0];
                 $underMB=$rowData[1];
                 $details=$rowData[2];
                 $subtotal=$rowData[3];
                 $ps=$rowData[4];
                 $str=$str."<tr align=\"center\"><td></td><td>$underMB</td><td>$details</td><td>$subtotal</td><td>$ps</td></tr>";
             }
             $str=$str."</table></div>";
         }
         return $str;
     }
     private static function getBonusReport5($data){
         $row=$data[5];
         $str="";
         if (count($row)>0){
             $str="<br><div class=\"table-responsive\"><table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" style=\"font-family:標楷體;\">";
             $str=$str."<tr bgcolor=\"#0066CC\"><td colspan=\"5\"><font color=\"#FFFFFF\" face=\"標楷體\">對碰獎金</font></td></tr> ";
             $str=$str."<tr id=\"header\" align=\"center\" bgcolor=\"#85E3F8\"><td width=\"5%\"></td><td width=\"30%\">日期</td><td width=\"35%\"><<<業績明細>>></td><td width=\"15%\">業績小計</td><td width=\"15%\">備註</td></tr>";
             for ($i=0;$i<count($row);$i++){
                 $rowData=$row[$i];
                 $levelNO=$rowData[0];
                 $underMB=$rowData[1];
                 $details=$rowData[2];
                 $subtotal=$rowData[3];
                 $ps=$rowData[4];
                 $str=$str."<tr align=\"center\"><td></td><td>$underMB</td><td>$details</td><td>$subtotal</td><td>$ps</td></tr>";
             }
             $str=$str."</table></div>";
         }
         return $str;
     }
     private static function getBonusReport6($data){
         $row=$data[6];
         $str="";
         if (count($row)>0){
             $str="<br><div class=\"table-responsive\"><table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" style=\"font-family:標楷體;\">";
             $str=$str."<tr bgcolor=\"#0066CC\"><td colspan=\"5\"><font color=\"#FFFFFF\" face=\"標楷體\">層碰獎金</font></td></tr> ";
             $str=$str."<tr id=\"header\" align=\"center\" bgcolor=\"#85E3F8\"><td width=\"5%\"></td><td width=\"30%\">日期</td><td width=\"35%\"><<<業績明細>>></td><td width=\"15%\">業績小計</td><td width=\"15%\">備註</td></tr>";
             for ($i=0;$i<count($row);$i++){
                 $rowData=$row[$i];
                 $levelNO=$rowData[0];
                 $underMB=$rowData[1];
                 $details=$rowData[2];
                 $subtotal=$rowData[3];
                 $ps=$rowData[4];
                 $str=$str."<tr align=\"center\"><td></td><td>$underMB</td><td>$details</td><td>$subtotal</td><td>$ps</td></tr>";
             }
             $str=$str."</table></div>";
         }
         return $str;
     }
     private static function getBonusReport7($data){
         $row=$data[7];
         $str="";
         if (count($row)>0){
             $str="<br><div class=\"table-responsive\"><table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" style=\"font-family:標楷體;\">";
             $str=$str."<tr bgcolor=\"#0066CC\"><td colspan=\"5\"><font color=\"#FFFFFF\" face=\"標楷體\">重消獎金</font></td></tr> ";
             $str=$str."<tr id=\"header\" align=\"center\" bgcolor=\"#85E3F8\"><td width=\"5%\"></td><td width=\"30%\">日期</td><td width=\"35%\"><<<業績明細>>></td><td width=\"15%\">業績小計</td><td width=\"15%\"><備註</td></tr>";
             for ($i=0;$i<count($row);$i++){
                 $rowData=$row[$i];
                 $levelNO=$rowData[0];
                 $underMB=$rowData[1];
                 $details=$rowData[2];
                 $subtotal=$rowData[3];
                 $ps=$rowData[4];
                 $str=$str."<tr align=\"center\"><td></td><td>$underMB</td><td>$details</td><td>$subtotal</td><td>$ps</td></tr>";
             }
             $str=$str."</table></div>";
         }
         return $str;
     }
     private static function getBonusReport8($data){
         $row=$data[8];
         $str="";
         if (count($row)>0){
             $str="<br><div class=\"table-responsive\"><table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" style=\"font-family:標楷體;\">";
             $str=$str."<tr bgcolor=\"#0066CC\"><td colspan=\"5\"><font color=\"#FFFFFF\" face=\"標楷體\">重消對等獎金</font></td></tr> ";
             $str=$str."<tr id=\"header\" align=\"center\" bgcolor=\"#85E3F8\"><td width=\"5%\"></td><td width=\"30%\">日期</td><td width=\"35%\"><<<業績明細>>></td><td width=\"15%\">業績小計</td><td width=\"15%\">備註</td></tr>";
             for ($i=0;$i<count($row);$i++){
                 $rowData=$row[$i];
                 $levelNO=$rowData[0];
                 $underMB=$rowData[1];
                 $details=$rowData[2];
                 $subtotal=$rowData[3];
                 $ps=$rowData[4];
                 $str=$str."<tr align=\"center\"><td></td><td>$underMB</td><td>$details</td><td>$subtotal</td><td>$ps</td></tr>";
             }
             $str=$str."</table></div>";
         }
         return $str;
     }
     private static function getBonusReport9($data){
         $row=$data[9];
         $str="";
         if (count($row)>0){
             $str="<br><div class=\"table-responsive\"><table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" style=\"font-family:標楷體;\">";
             $str=$str."<tr bgcolor=\"#0066CC\"><td colspan=\"5\"><font color=\"#FFFFFF\" face=\"標楷體\">重消獎金</font></td></tr> ";
             $str=$str."<tr id=\"header\" align=\"center\" bgcolor=\"#85E3F8\"><td width=\"5%\"></td><td width=\"30%\">日期</td><td width=\"35%\"><<<業績明細>>></td><td width=\"15%\">業績小計</td><td width=\"15%\">備註</td></tr>";
             for ($i=0;$i<count($row);$i++){
                 $rowData=$row[$i];
                 $levelNO=$rowData[0];
                 $underMB=$rowData[1];
                 $details=$rowData[2];
                 $subtotal=$rowData[3];
                 $ps=$rowData[4];
                 $str=$str."<tr align=\"center\"><td></td><td>$underMB</td><td>$details</td><td>$subtotal</td><td>$ps</td></tr>";
             }
             $str=$str."</table></div>";
         }
         return $str;
     }
     private static function getBonusReport10($data){
         $row=$data[10];
         $str="";
         if (count($row)>0){
             $str="<br><div class=\"table-responsive\"><table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" style=\"font-family:標楷體;\">";
             $str=$str."<tr bgcolor=\"#0066CC\"><td colspan=\"5\"><font color=\"#FFFFFF\" face=\"標楷體\">重消對等獎金</font></td></tr> ";
             $str=$str."<tr align=\"center\" bgcolor=\"#85E3F8\"><td width=\"5%\"></td><td width=\"30%\">日期</td><td width=\"35%\"><<<業績明細>>></td><td width=\"15%\">業績小計</td><td width=\"15%\">備註</td></tr>";
             for ($i=0;$i<count($row);$i++){
                 $rowData=$row[$i];
                 $levelNO=$rowData[0];
                 $underMB=$rowData[1];
                 $details=$rowData[2];
                 $subtotal=$rowData[3];
                 $ps=$rowData[4];
                 $str=$str."<tr align=\"center\"><td></td><td>$underMB</td><td>$details</td><td>$subtotal</td><td>$ps</td></tr>";
             }
             $str=$str."</table></div>";
         }
         return $str;
     }
     private static function getWeekNoListData($datas,$weekNo,$choice=0){
         $data=$datas[0];
         $tag=false;
         $str1="<font face=\"標楷體\">業績期別:</font>";
         if ($choice==0){//獎金明細
             $action="index.php?menuID=7&WeekNo=";
             $str=" <form action='index.php?menuID=7' method='get'>$str1
                <select name=\"WeekNo\" style=\"color:black;\" onChange=\"location = this.options[this.selectedIndex].value;\">";
         }
         else{
             $action="index.php?menuID=".$choice."&WeekNo=";
             $str=" <form action='index.php?menuID=".$choice."' method='get'>".$str1."
                <select name=\"WeekNo\" style=\"color:black;\" onChange=\"location = this.options[this.selectedIndex].value;\">";
             $nowNo=Session::get('weekNo');
             $nowNewest=Session::get('weekNewest');
             if ($weekNo==''){
                 $str=$str."<option value=\"$action$nowNo\" selected=\"true\" style=\"color:black\"><font face=\"標楷體\">請選擇</font></option>";
                 $tag=true;
             }
             $str=$str."<option value=\"$action$nowNewest\" style=\"color:black\"><font face=\"標楷體\">".$nowNewest."</font></option>";
             //              $str=$str."<option value=\"$action$nowNo\" selected=\"true\"><font face=\"標楷體\">$nowNo</font></option>";
             //
         }         
         for($i=0;$i<count($data);$i++){
             $row=$data[$i];
             $wNo=$row[0];
             if ($weekNo==''){
                 if ($i==0 && !$tag){
                     $str=$str."<option value=\"$action$wNo\" selected=\"true\" style=\"color:black\"><font face=\"標楷體\">$wNo</font></option>";
                 }
                 else{
                     $str=$str."<option value=\"$action$wNo\" style=\"color:black\"><font face=\"標楷體\">$wNo</font></option>";
                 }
             }
             else{
                 if (strcmp($weekNo,$wNo)==0 && !$tag){
                     $str=$str."<option value=\"$action$wNo\" selected=\"true\" style=\"color:black\"><font face=\"標楷體\">".$wNo."</font></option>";
                 }
                 else{
                     $str=$str."<option value=\"$action$wNo\" style=\"color:black\"><font face=\"標楷體\">".$wNo."</font></option>";
                 }
             }
         }         
         $str=$str."</select>
                </form>";
         return $str;
     }
     public static function getOrderHistory($account,$bdate,$edate){
         $object = array();
         $object['account']=$account;
         $object['bdate']=$bdate;
         $object['edate']=$edate;
         $result = ApiHandler::callApi('getOHistory', $object);
         $code = $result['code'];
         $object=array();
         $object['code']=$code;
         $data=array();
         if ($code==1){
             $data=$result['data'];
         }
             $object['data']=$data;
         return $object;
     }
     public static function getOrderDetail($account,$ordNO){
         $object = array();
         $object['account']=$account;
         $object['ordNO']=$ordNO;
         $result = ApiHandler::callApi('getODetail', $object);
         $code = $result['code'];
         $object=array();
         $object['code']=$code;
         $data=array();
         if ($code==1){
             $data=$result['data'];
         }
         $object['data']=$data;
         return $object;
     }
     public static function GetORGSEQ_T($account){
         $object = array();
         $object['account']=$account;
         $result = ApiHandler::callApi('getORGSEQ_T', $object);
         $code = $result['code'];
         $object=array();
         $object['code']=$code;
         $data=array();
         if ($code==1){
             $data=$result['data'];
             $ct=sizeof($data);
             foreach($data as $key=>$row){
                 switch($key){
                     case 0:
                         $object['WeekNO']=$row['0'][0];
                         break;
                     case 1:
                         $row1=$row[0];
                         $member=array(
                             'MB_NO'=>$row1['0'], //TOP_MB_NO
                             'MB_NAME'=>$row1['1'], //TOP_MB_NAME
                             'TRUE_INTRO_NO'=>$row1['2'], //TRUE_INTRO_NO
                             'PG_DATE'=>$row1['3'], //PG_DATE
                             'GRADE_NAME'=>$row1['4'], //GRADE_NAME
                             'LEVEL_NO_T'=>$row1['5'], //LEVEL_NO_T
                             'ORGSEQ_NO_T'=>$row1['6'], //ORGSEQ_NO_T
                             'LEVELLINEFLAG_T'=>$row1['7'], //LEVELLINEFLAG_T
                         );
                         $object['member']=$member;
                         break;
                     case 2:
                         $ct1=sizeof($row);
                         $orgseq=array();
                         for($j=0;$j<$ct1;$j++){
                             $row1=$row[$j];
                             $member=array(
                                 'MB_NO'=>$row1['0'], //MB_NO
                                 'MB_NAME'=>$row1['1'], //MB_NAME
                                 'TRUE_INTRO_NO'=>$row1['2'], //TRUE_INTRO_NO
                                 'PG_DATE'=>$row1['3'], //PG_DATE
                                 'GRADE_NAME'=>$row1['4'], //GRADE_NAME
                                 'PER_M'=>$row1['5'], //PER_M
                                 'LEVEL_NO_T'=>$row1['6'], //LEVEL_NO_T
                                 'ORGSEQ_NO_T'=>$row1['7'], //ORGSEQ_NO_T
                                 'LEVELLINEFLAG_T'=>$row1['8'], //LEVELLINEFLAG_T
                                 'MB_STATUS'=>$row1['9'], //MB_STATUS
                             );
                             $orgseq[]=$member;
                         }
                         $object['orgseq']=$orgseq;
                         break;
                 }
             }
         }
         return $object;
     }
}