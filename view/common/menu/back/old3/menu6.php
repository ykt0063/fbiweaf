<?php
use report\organization\Personal;
use report\user\Session;
$account=SESSION::get('account');
$weekNo1=isset($g['WeekNo'])?$g['WeekNo']:'';
$strList = Personal::GetBonusReport0($account,$weekNo1,'6');
?>
	<br><br><br><br><br>
    <div class="table-responsive">
    	   <table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
                  <tr> 
                    <td width="30%" height="47">&nbsp;</td>
                    <td width="40%"> <div align="center"><h3><font face="標楷體"><b>會員[安置]組織圖</b></font></h3></div></td>
                    <td width="30%">&nbsp;</td>
                  </tr>
                  <tr> 
                    <td width="30%" height="47">&nbsp;</td>
                    <td width="40%"> <div align="center"><h3><?php echo $strList?></h3></div></td>
                    <td width="30%">&nbsp;</td>
                  </tr>
           </table>

<?php
//echo "<h3 align=\"center\">".$strList."</h3>";
if ($weekNo1==''){
?>
	</div>
<?php 
}
else{
    $object=array(
        'weekNo' => $weekNo1
    );
    Session::save($object);
    $str='';
    $columnName=array();
    if (null!=SESSION::get('account')){
        $account=SESSION::get('account');
        $weekNo = Session::get('weekNo');
        $result = Personal::dualSystem($account,$weekNo);
        if ($result['code']==0){
            //         $listA = $result['data'];
            $data=$result['data'];
            $str=$data->getPath();
            $columnName=$result['columnName'];
            $nmmberCT = $data->getMumberct();
            $rPV = $data->getRightPV();
            $lPV = $data->getLeftPV();
            $tPV = $data->getTotalPV();
            $name = Session::get('name');
            $weekNo = Session::get('weekNo');
            $pgHeader="<h3 align=\"left\"><font face=\"標楷體\">會員：<image src='/assets/images/black.jpg' height='10' width='10'><br>合格：<image src=/assets/images/blue.jpg height='10' width='10'><br>轉讓：<image src=/assets/images/red.jpg height='10' width='10'><br></font></h3>";
            $pg= "<h2 align=\"center\"><font face=\"標楷體\">$name</font></h2><br><h2 align=\"center\"><font face=\"標楷體\">會員[安置]組織圖</font></h2><br><h3>";
            $pg=$pg."<h3 align=\"center\"><p><font face=\"標楷體\">左線</font>: $lPV</p><p><font face=\"標楷體\">右線</font>: $rPV</p></h3>";
            $pg=$pg."<h3><p align=\"right\"><font face=\"標楷體\">人数：".$data->getMumberct()." 業績期別</font>: $weekNo &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</p></h3>";
            
            $pgHeader="<div class=\"row\">";
            $pgHeader=$pgHeader."<div class=\"col-xs-6 col-sm-4\"><h3 class=\"h3 font-weight-normal\"><font face=\"標楷體\">會員</font>：<image src='/assets/images/black.jpg' height='10' width='10'></h3></div>";
            $pgHeader=$pgHeader."<div class=\"col-xs-6 col-sm-4\" align='center'><h3 class=\"h3 font-weight-normal\"><font face=\"標楷體\"><b>$name</b></font></h3></div>";
            $pgHeader=$pgHeader."<div class=\"col-xs-6 col-sm-4\"><h3 class=\"h3 font-weight-normal\"><font face=\"標楷體\"></font></h3></div>";
            $pgHeader=$pgHeader."</div>";
            $pgHeader=$pgHeader."<div class=\"row\">";
            $pgHeader=$pgHeader."<div class=\"col-xs-6 col-sm-4\"><h3 class=\"h3 font-weight-normal\"><font face=\"標楷體\">合格</font>：<image src='/assets/images/blue.jpg' height='10' width='10'></h3></div>";
            $pgHeader=$pgHeader."<div class=\"col-xs-6 col-sm-4\" align='center'><h3 class=\"h3 font-weight-normal\"><font face=\"標楷體\"><b>會員[安置]組織圖</b></font></h3></div>";
            $pgHeader=$pgHeader."<div class=\"col-xs-6 col-sm-4\"><h3 class=\"h3 font-weight-normal\"><font face=\"標楷體\"></font></h3></div>";
            $pgHeader=$pgHeader."</div>";
            $pgHeader=$pgHeader."<div class=\"row\">";
            $pgHeader=$pgHeader."<div class=\"col-xs-6 col-sm-4\"><h3 class=\"h3 font-weight-normal\"><font face=\"標楷體\">轉讓</font>：<image src='/assets/images/red.jpg' height='10' width='10'></h3></div>";
            $pgHeader=$pgHeader."<div class=\"col-xs-6 col-sm-4\" align='center'><h3 class=\"h3 font-weight-normal\"><p><font face=\"標楷體\">左線</font>: $lPV <font face=\"標楷體\">右線</font>: $rPV</p></h3></div>";
            $pgHeader=$pgHeader."<div class=\"col-xs-6 col-sm-4\"><h4 class=\"h4 font-weight-normal\"><font face=\"標楷體\">人数：</font>".$data->getMumberct()."<font face=\"標楷體\"> 業績期別</font>: $weekNo</h4></div>";
            $pgHeader=$pgHeader."</div>";
            
            $pg="";
            
            
            $str1=$pgHeader.$pg;
            $str2=$data->getPath();
        }
    }
    /*
     <table>
     <thead>
     <tr>
     <th><?php echo implode('</th><th>', array_values($columnName)); ?></th>
     </tr>
     </thead>
     <tbody>
     <?php foreach ($listA as $row): array_map('htmlentities', $row); ?>
     <tr>
     <td><?php echo implode('</td><td>', $row); ?></td>
     </tr>
     <?php endforeach; ?>
     </tbody>
     </table>
     <h3 align="left">ERP網站功能顯示-安置組織圖</h3><hr/>
     */
    
    //echo $str1."<hr/>";
    ?>
     	   <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr> 
                    <td width="30%" height="47"><h3 class="h3 font-weight-normal"><font face="標楷體">會員</font>：<image src='/assets/images/black.jpg' height='10' width='10'></h3></td>
                    <td width="40%"> <div align="center"><h3><font face="標楷體"><b><?php echo $name?></b></font></h3></div></td>
                    <td width="30%">&nbsp;</td>
                  </tr>
           </table>
     	   <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr> 
                    <td width="30%" height="47"><h3 class="h3 font-weight-normal"><font face="標楷體">合格</font>：<image src='/assets/images/blue.jpg' height='10' width='10'></h3></td>
                    <td width="40%"> <div align="center"><font face="標楷體">&nbsp;</font></div></td>
                    <td width="30%"><h4><font face="標楷體">人数：</font><?php echo $data->getMumberct()?></h4></td>
                  </tr>
           </table>
     	   <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr> 
                    <td width="30%" height="47"><h3 class="h3 font-weight-normal"><font face="標楷體">轉讓</font>：<image src='/assets/images/red.jpg' height='10' width='10'></h3></td>
                    <td width="40%"> <div align="center"><h3 class="h3 font-weight-normal"><p><font face="標楷體">左線</font>: <?php echo $lPV ?> <font face="標楷體">右線</font>: <?php echo $rPV?></p></h3></div></td>
                    <td width="30%"><h4><font face="標楷體"> 業績期別</font>: <?php echo $weekNo?></h4></td>
                  </tr>
           </table>
		   <hr/>
     	   <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr> 
                    <td width="100%">
                    	<div id="jstree" align="left">
                    		<ul><?php echo $data->getPath()?></ul>
						</div>
					</td>
                  </tr>
           </table>
    </div>
<?php 
}
?>