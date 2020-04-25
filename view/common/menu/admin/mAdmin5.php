<?php

use report\user\Auth;

?>
<style type="text/css"> @import url("<?=WEB_ASSET_URL?>css/jquery.multiselect.css"); </style>
<script src="<?=WEB_ASSET_URL?>js/jquery.multiselect.js"></script>
<script type="text/javascript">
jQuery(function () {
    jQuery("#selAdminID").gs_multiselect1();
});
</script>
<script>
function checkAD2Select(){
        //$('#selCategoryID').attr("name" :"selCategoryID");
        var parameterStr = $('#mAd2Product').serialize();
        $.ajax({
        type: "POST",
        url: defUrl+"ajax/setAdmin.php",
        data: parameterStr,
        dataType:'json',
        success: function(data) {
            if(data['code'] == 1){
                    document.getElementById("mAd2Product").reset();
                alert('已設定完成');
                
                WebTool.webPageOpenByPost(defUrl,{menuID:'25'});
            }else{
                                alert(data['desc']);
                                //alert('影像檔案不正確,請重新上傳');
            }
        },
        error:function(xhr, ajaxOptions, thrownError){
            alert(thrownError);
                }
    });
    return;
}
</script>
<div style="min-height: 700px;">
    <div>
                <div>
                        <font style="font-size:30pt">設定管理人員</font>
                </div>
                <div>
                        <img src="assets/images/login/contentHLine.png" style="width:100%;vertical-align: top;">
                </div>
                <div>
                        <font style="font-size: 12px">HOME>會員中心>管理功能><font style="color:red">設定管理人員</font></font>
                </div>
        </div>
<?php
$res=Auth::getAdminlist();
if ($res['code']==0){
    $data=$res['data'];
    $arr1=array();
    $arr2=array();
    $selStr='<select id="selAdminID"  multiple="multiple" style="color:black">'.PHP_EOL;
    foreach($data as $key => $row){
        $mbNO=$row['MB_NO'];
        $mbName=$row['MB_NAME'];
        $tag=$row['TAG'];
        $row1=array(
            'mbNO'=>$mbNO,
            'mbName'=>$mbName,
            'tag'=>$tag,
        );
        if($tag){
            $arr2[]=$row1;
            $selStr=$selStr.'<option value="'.$mbNO.'" selected>'.$mbNO.":".$mbName.'</option>'.PHP_EOL;
        }
        else{
            $arr1[]=$row1;
            $selStr=$selStr.'<option value="'.$mbNO.'">'.$mbNO.":".$mbName.'</option>'.PHP_EOL;
        }
    }
    $selStr=$selStr.'</select>'.PHP_EOL;
    ?>
        <div>
                <div>
                        <h1>管理人員:</h1>
                </div>
                <div>
                        <FORM id="mAd2Product" name="mAd2Product" action='index.php' enctype="multipart/form-data" method="post">
                                <?=$selStr?>
                                <button type="submit" onclick="checkAD2Select()" class="btn btn-default">設定</button>
                        </FORM>
                </div>
        </div>
<?php
}

?>
</div>
             