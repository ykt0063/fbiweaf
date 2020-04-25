<?php
use report\organization\Personal;
use report\user\Session;
$account='';
// $listA=array();
$str='';
$Line_Head_Flag = array();
for ($i = 1; $i <= 80; $i++) {
    $Line_Head_Flag[$i] = 1;
    //$output=implode(",",$Line_Head_Flag);
}
$columnName=array();
if (null!=SESSION::get('account')){
    $account=SESSION::get('account');
    $weekNo1=isset($g['WeekNo'])?$g['WeekNo']:'';
    if (isset($g['acno'])&&$g['acno']<>'')
        $account=isset($g['acno'])?$g['acno']:$account;
        
        $obj = Personal::GetORGSEQ_T($account);
        $code=$obj['code'];
        if ($code==1){
            $member=$obj['member'];
            $now_week_no=$obj['WeekNO'];
            ?>
    <div style="min-height: 700px;">
    	<div>
			<div>
				<font style="font-size:30pt">組織圖</font>
			</div>
			<div>
				<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
			</div>
			<div>
				<font style="font-size: 12px">HOME>會員中心><font style="color:red">組織圖-帳號：<?=$account?></font></font>
			</div>
		</div>
		<div>
			<table class="table table-hover">
            	<thead>
            	  <tr>
            	    <td class="text-right" width="5%">層</td>
            	    <td class="text-left">會員姓名-加入日期</td>
            	    <td class="text-right"><?php echo $now_week_no; ?>業績</td>
            	  </tr>
            	</thead>
            	<tbody>
<?php 
        $orgseq=$obj['orgseq'];
        $ct=sizeof($orgseq);
        for($i=0;$i<$ct;$i++){
?>
					<tr>
<?php 
            $row=$orgseq[$i];
            $l=$row['LEVEL_NO_T']-$member['LEVEL_NO_T'];
            $levellineflag_t=$row['LEVELLINEFLAG_T'];
            $mb_status=$row['MB_STATUS'];
            if (isset($mb_status)) {
                if ($mb_status=="1") {
                    $status="";
                }
                if ($mb_status=="2") {
                    $status="(停權)";
                }
                if ($mb_status=="3") {
                    $status="(轉讓)";
                }
            }
            $pre="";
            $j=1;
            while ($j <= $l) {
                if ($Line_Head_Flag[$j] == 1) {
                    $pre=$pre.'Ｐ';
                }
                if ($Line_Head_Flag[$j] == 2) {
                    $pre=$pre.'│';
                }
                $j++;
            }
            if ($levellineflag_t == '└') {
                $Line_Head_Flag[$l+1] = 1;
            } elseif ($l > 0) {
                $Line_Head_Flag[$l+1] = 2;
            }
            $spacer="";
            $spacer=$pre.$levellineflag_t.$row['MB_NAME'];
            //echo $spacer."<br>";
            $spacer = str_replace("Ｐ", "&emsp;", $spacer);
?>
						<td class="text-right" width="5%"><?php echo $l; ?></td>
                  		<td><a href="#" onclick="handlerOrg('8','<?=$row['MB_NO']?>'); return false;" style="text-decoration:none;"><?php echo $spacer.'-'.date("Y-m-d", strtotime($row['PG_DATE'])).' '.$row['GRADE_NAME'].$status; ?></a></td>
                  		<td class="text-right"><?php echo $row['PER_M']; ?></td>
                	</tr>
<?php 
        }
?>
            	</tbody>
            </table>
		</div>
	</div>
<?php         
    }
}