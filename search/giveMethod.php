<?php
use report\base\Json;
use report\tool\FuzzySearch;
require_once( __DIR__."/../init.inc.php" );
require_once( __DIR__."/../view/common/head.php" );
$search=isset($g['search'])?$g['search']:'';
$tag=false;
$msg="";
if ($search!=''){
    $tmpAry = explode (" ", $search);
    if (count($tmpAry)==2){
        $p1=$tmpAry[0];
        $p2=$tmpAry[1];
        $result=FuzzySearch::searchButton(2, $p1,$p2);
        $code=$result['code'];
        if ($code==0){
            $tag=true;
        }
    }
    else{
        $msg="輸入查尋資料不正確:".$search;
    }
}
else{
    $msg="查詢資料不可空白";
}
if ($tag){
    ?>
	<script type="text/javascript">
		function checkChoice(){
			var choice = $('#searchRadio input:radio:checked').val()
			if (choice.length>0){
				var obj=JSON.parse(choice);
				$("#giveMethodNo",opener.document).val(obj.give_method_no);
				$("#giveMethod",opener.document).val(obj.give_method);
				window.close();
			}
			else{
				alert('請選擇正確資料');
			}
		}
	</script>
	<p>
		<h3>查詢資料如下</h3>
		<div class="form-group" id="searchRadio">
<?php 
    $data=$result['data'];
    $num=count($data);
//     for ($i=0;$i<$num;$i++){
    $i=0;
    foreach($data as $row){
        $tmpNo=$row['give_method_no'];
        $tmpName=$row['give_method'];
        $tmpary=array();
        $tmpary['give_method_no']=$tmpNo;
        $tmpary['give_method']=$tmpName;
        $tmpString=Json::encode($tmpary);
        $check='';
        if ($i==0){
            $check='checked';
        }
        $i=$i+1;
?>
			<div class="col-md-2">
				<div class="radio">
					<label><input type="radio" name="trueIntroName" value=<?php echo $tmpString?> <?php echo $check?>><?php echo $tmpName?></label>
				</div>
			</div>
<?php 
    }
?>
			<input type="button" class="btn btn-info btn-lg" onclick="checkChoice()" value="確認">
		</div>
	</p>
<?php     
}
else{
?>
	<p>
		<h3>無法查詢</h3>
		<?php echo $msg?>
	</p>
<?php 
}