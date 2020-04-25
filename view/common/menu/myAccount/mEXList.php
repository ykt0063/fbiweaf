<?php
use report\organization\Personal;
use report\user\Session;
$account='';
// $listA=array();
$str='';
$eff=Session::get('eff');
if (is_null($eff)){
    $eff=0;
}
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
    
    $obj = Personal::getEXList($account,$bDate,$eDate);
    $code=$obj['code'];
    if ($code==1){
        
        ?>
    <div style="min-height: 700px;">
    	<div>
			<div>
				<font style="font-size:30pt">購物金明細</font>
			</div>
			<div>
				<img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
			</div>
			<div>
				<font style="font-size: 12px">HOME>會員中心><font style="color:red">-帳號：<?=$account?> 購物金明細</font>(現有點數:<?=$eff?>)</font>
			</div>
			<div>
				<form class="form-horizontal"  role="form" id="mainForm" enctype="multipart/form-data" method="post">
				    <input type="hidden" id='menuID' name="menuID" value='7'>
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
            	    <td class="text-center">產生類別</td>
            	    <td class="text-center">生效日期</td>
            	    <td class="text-center">產生日期</td>
            	    <td class="text-center">周別</td>
            	    <td class="text-center">點數</td>
            	  </tr>
            	</thead>
            	<tbody>
<?php 
        $data=$obj['data'];
        for($i=0;$i<sizeof($data);$i++){
?>
					<tr>
<?php 
            $row=$data[$i];
            $kind=$row['KIND'];
            $effDate=$row['effDate'];
            $usedDate=$row['usedDate'];
            $weekNO=$row['WEEK_NO'];
            $exPoint=$row['EXPoint'];
?>
					
						<td class="text-center"><?=mb_substr($kind,0,4,'utf-8')?></td>
						<td class="text-center"><?=$effDate?></td>
						<td class="text-center"><?=$usedDate?></td>
						<td class="text-center"><?=$weekNO?></td>
						<td class="text-center"><?=$exPoint?></td>
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
