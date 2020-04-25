<?php
use report\base\Json;
use report\tool\FuzzySearch;
require_once( __DIR__."/../init.inc.php" );
require_once( __DIR__."./../view/common/head.php" );
$search=isset($g['search'])?$g['search']:'';
$tag=false;
$msg="";
if ($search!=''){
    $result=FuzzySearch::searchButton(1, $search,'');
    $code=$result['code'];
    if ($code==0){
        $tag=true;
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
// 				parent.$("#trueIntroName").val(obj.MBNAME);
// 				parent.$("#trueIntroNo").val(obj.MBNO);
				$("#trueIntroName",opener.document).val(obj.MBNAME);
				$("#trueIntroNo",opener.document).val(obj.MBNO);
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
			<div class="col-md-9">
				<div class="radio">
<?php 
    $i=0;
    $data=$result['data'];
    foreach( $data as $row ){
        $tmpNo=$row['MB_NO'];
        $tmpName=$row['MB_NAME'];
        $tmpary=array();
        $tmpary['MBNO']=$tmpNo;
        $tmpary['MBNAME']=$tmpName;
        $tmpString=Json::encode($tmpary);
        $check='';
        if ($i==0){
            $check='checked';
        }
        $i=$i+1;
?>
					<label><input type="radio" name="trueIntroName" value=<?php echo $tmpString?> <?php echo $check?>><?php echo $tmpName?></label>
<?php 
    }
?>
				</div>
				<input type="button" class="btn btn-info btn-lg" onclick="checkChoice()" value="確認">
			</div>
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