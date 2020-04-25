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
    $bDate=date('Y-m-d',(strtotime("now")-86400*31));
    if (isset($g['bDate'])){
        if ($g['bDate']==180)
            $bDate=date('Y-m-d',(strtotime("now")-86400*181));
    }
    $eDate=date('Y-m-d',(strtotime("now")+86400));
    $weekNo1=isset($g['WeekNo'])?$g['WeekNo']:'';
    //$account=isset($g['acno'])?$g['acno']:$account;
    
    $obj = Personal::getRedSunHistoryData($bDate,$eDate);
    $code=$obj['code'];
    if ($code==1){
        
?>
<div style="min-height: 700px;">
    <div>
		<div>
			<font style="font-size:30pt">紅陽交易資料</font>
		</div>
		<div>
			<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
		</div>
		<div>
			<font style="font-size: 12px">HOME>會員中心>管理功能><font style="color:red">紅陽交易資料</font></font>
		</div>
		<div>
			<form class="form-horizontal"  role="form" id="mainForm" enctype="multipart/form-data" method="post">
			    <input type="hidden" id='menuID' name="menuID" value='23'>
				<input type="hidden" id="mainID" name="mainID" value='0'>
				<input type="hidden" class="form-control input-lg" id="account" name="account" value="<?=$account?>">
				<input type="hidden" class="form-control input-lg" id="bDate" name="bDate" value="">
				<div class="form-group">
					<div class="col-md-5">
						<div class="row">
							<div class="col-md-6 regwd">
								<label for "range" class="control-label" style="text-align: left"><font face="標楷體" style="font-size: 15px">查詢區間</font></label>
							</div>
						</div>
						<div class="radio">
  							<label><input type="radio" name="range" value=1 checked="checked">預設（30天）</label>
  							<label><input type="radio" name="range" value=2>180天</label>
						</div>
					</div>
					<div class="col-md-1">
					</div>
				</div>
			</form>
		</div>
	</div>
	<div>
		<table class="table table-hover">
           	<thead>
           	  <tr>
           	    <td class="text-center">訂單日期</td>
           	    <td class="text-center">會員代碼</td>
           	    <td class="text-center">會員姓名</td>
           	    <td class="text-center">紅陽交易代碼</td>
           	    <td class="text-center">本系統交易代碼</td>
           	    <td class="text-center">信用卡後四碼</td>
           	    <td class="text-center">核准碼</td>
           	    <td class="text-center">交易金額</td>
           	  </tr>
           	</thead>
           	<tbody>
<?php 
        $data=$obj['data'];
        for($i=0;$i<sizeof($data);$i++){
            $row=$data[$i];
            $oDate=$row['orderTime'];
            $uID=$row['userID'];
            $uName=$row['userName'];
            $rsTNO=$row['rsTradeNo'];
            $tNO=$row['tradeNo'];
            $cCode=$row['creditCode'];
            $aCode=$row['approveCode'];
            $tPrice=$row['tradePrice'];
            ?>
			  <tr>
			  	<td class="text-right"><?=$oDate?></td>
				<td class="text-right"><?=$uID?></td>
				<td class="text-right"><?=$uName?></td>
				<td class="text-right"><?=$rsTNO?></td>
				<td class="text-right"><?=$tNO?></td>
				<td class="text-right"><?=$cCode?></td>
				<td class="text-right"><?=$aCode?></td>
				<td class="text-right"><?=$tPrice?></td>
			  </tr>
<?php 
        }
?>
           	</tbody>
        </table>
	</div>
</div>
<script>
$( document ).ready(function() {
	$('input[type=radio][name=range]').change(function(){
		if (this.value == 1) {
			$('#bDate').val(30);
		}
		else{
			$('#bDate').val(180);
		}
		document.getElementById("mainForm").submit();
	});
<?php 
	    if (isset($g['bDate'])&& ($g['bDate']==180)){
	?>
			$("input[name=range][value=2]").prop('checked', true);
	<?php 
	    }
	    else{
	?>
			$("input[name=range][value=1]").prop('checked', true);
	<?php 
	    }
	?>		
		});
</script>
<?php 
    }
}
?>