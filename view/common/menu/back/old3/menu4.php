<?php
use report\organization\Personal;
use report\user\Session;
$account='';
// $listA=array();
$str='';
$columnName=array();
if (null!=SESSION::get('account')){
    $account=SESSION::get('account');
    $weekNo1=isset($g['WeekNo'])?$g['WeekNo']:'';
    
    $strList = Personal::GetBonusReport0($account,$weekNo1,'4');
    ?>
    <br><br><br><br><br>
    <div class="table-responsive">
    	   <table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
                  <tr> 
                    <td width="30%"><div align="center"></div></td>
                    <td width="40%"><div align="center"><h3><font face="標楷體"><b>會員[直推]組織圖</b></font></h3></div> </td>
                    <td width="30%">&nbsp;</td>
                  </tr>
                  <tr> 
                    <td width="30%"><div align="center"></div></td>
                    <td width="40%"><div align="center"><h3><?php echo $strList?></h3></div> </td>
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
        $weekNo = Session::get('weekNo');
        $result = Personal::sunLine($account,$weekNo);
        if ($result['code']==0){
            //         $listA = $result['data'];
            $data = $result['data'];
            $columnName=$result['columnName'];
            $name = Session::get('name');
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
                    <td width="40%"> <div align="center">&nbsp;</div></td>
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
    }
}
