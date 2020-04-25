<?php
use report\organization\Personal;
use report\user\Session;
$account=SESSION::get('account');
$weekNo1=isset($g['WeekNo'])?$g['WeekNo']:'';
$strList = Personal::GetBonusReport0($account,$weekNo1,'5e');
?>
<div class="table-responsive">
	<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
		<tr> 
	        <td width="30%" height="47">&nbsp;</td>
            <td width="40%"> <div align="center"><h3><font face="標楷體"><b>安置組織-立式</b></font></h3></div></td>
            <td width="30%"><h4 align="right">&nbsp;</h4></td>
        </tr>
		<tr> 
	        <td width="30%" height="47">&nbsp;</td>
            <td width="40%"> <div align="center"><h3><?php echo $strList?></h3></div></td>
            <td width="30%"><h3 align="right">&nbsp;</h3></td>
        </tr>
	</table>
</div>

<?php
//echo "<h3 align=\"center\">".$strList."</h3>";
if ($weekNo1!=''){
    $object=array(
        'weekNo' => $weekNo1
    );
    Session::save($object);

    $actual_link = strtok((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]","?");
    // $listA=array();
    $str='';
    $columnName=array();
    $orgNO = isset($g['orgNO'])?$g['orgNO']:'';
    $weekNo = Session::get('weekNo');
    if ($orgNO!=''){
        if (null!=SESSION::get('account')){
            $account=SESSION::get('account');
            $accountLevel=SESSION::get('accountLevel');
            $weekNo = Session::get('weekNo');
            $result = Personal::dualSystemLevel($account,$orgNO,$accountLevel,$weekNo);
            if ($result['code']==0){
                //         $listA = $result['data'];
                $data=$result['data'];
                $str=$data->getPath();
                $columnName=$result['columnName'];
                $nmmberCT = $data->getMumberct();
                $rPV = $data->getRightPV();
                $lPV = $data->getLeftPV();
                $tPV = $data->getTotalPV();
            }
        }
    }else {
        if (null!=SESSION::get('account')){
            $account=SESSION::get('account');
            $accountLevel=SESSION::get('accountLevel');
            $result = Personal::dualSystemLevel($account,'',$accountLevel,$weekNo);
            if ($result['code']==0){
                //         $listA = $result['data'];
                $data=$result['data'];
                $columnName=$result['columnName'];
                $str=$data->getPath();
                $nmmberCT = $data->getMumberct();
                $rPV = $data->getRightPV();
                $lPV = $data->getLeftPV();
                $tPV = $data->getTotalPV();
            }
        }
    }
?>    
<div id="chart_div" align="center" ></div>
        <script type="text/javascript">
      google.charts.load('current', {packages:["orgchart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');

        // For each orgchart box, provide the name, manager, and tooltip to show.
        data.addRows([
          <?php echo $str; ?>
        ]);

        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {allowHtml:true});
      }
   </script>
<?php 
}
?>


