<?php
use report\user\Session;
use report\organization\Personal;
$account='';
$str='';
$columnName=array();
$strWeekNolist='獎金明細';
$strReport='';
if (null!=SESSION::get('account')){
    $account=SESSION::get('account');
    $weekNo=isset($g['WeekNo'])?$g['WeekNo']:'';
    //$strWeekNolist = Personal::GetWeekNoList($weekNo);
    $obj = Personal::GetBonusReport($account,$weekNo);
    $strReport=$obj[0];
    $strWeekNolist=$obj[1];
}

?>
<br><br><br><br><br>
<h3 align="center"><font face="標楷體"><b>獎金明細</b></font></h3>
<h3 align="center"><font face="標楷體"><?php echo $obj[0]?></font></h3>
<?php echo $obj[1];?>

