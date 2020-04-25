<?php
//use report\system\Web;
use report\user\Session;

require_once( __DIR__."/../init.inc.php" );
require_once( __DIR__."/common/head.php" );
Session::deleteAll();
clearstatcache();
session_unset();
//session_destroy();
?>
<body>
<script type="text/javascript">
var url=defUrl+"assets/css/Register.css";
var wsWidth=$(window).width();
$('head').append('<link rel="stylesheet" href='+url+' type="text/css" />');
$(function () {
});
function searchButton(choice){
	var url='';
	var parameter1='';
	var parameter2='';
	var message='';
	if (choice==1 || choice==2){
		var tag=false;
		if (choice==1){
			parameter1="trueIntroName";
			parameter2=$.trim($('#trueIntroName').val());
			if (parameter2.length>=2){
				tag=true;
			}
			else{
				message="請輸入推薦人名字:全名或前兩隻字";
			}
		}
		else{
			parameter1="giveMethod";
			parameter2=$.trim($('#giveMethod').val());
			if (parameter2.length>=0){
				tag=true;
			}
			else{
				message="請輸入金融機構名稱(加空格)與分行名稱"
			}
		}
		if (tag){
			url= "index.php?p1=search/"+parameter1+"&search="+parameter2;
			window.open(url);
		}
		else
			alert(message);
	}
}
function validateEmail() {
	sEmail = $('#inputEmail3').val();
	var filter = /\S+@\S+\.\S+/;
	if (sEmail.length>0){
		if (!filter.test(sEmail)) {
			//return false;
			alert('EMAIL格式錯誤');
		}
	}
}
function isValidDate(dateString){
	// First check for the pattern
    if(!/^\d{4}\-\d{1,2}\-\d{1,2}$/.test(dateString))
        return false;

    // Parse the date parts to integers
    var parts = dateString.split("-");
    var day = parseInt(parts[2], 10);
    var month = parseInt(parts[1], 10);
    var year = parseInt(parts[0], 10);

    // Check the ranges of month and year
    if(year < 1000 || year > 3000 || month == 0 || month > 12)
        return false;

    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

    // Adjust for leap years
    if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
        monthLength[1] = 29;

    // Check the range of the day
    return day > 0 && day <= monthLength[month - 1];
}
function checkBossID( id ) {
	  tab = "ABCDEFGHJKLMNPQRSTUVXYWZIO"                     
	  A1 = new Array (1,1,1,1,1,1,1,1,1,1,2,2,2,2,2,2,2,2,2,2,3,3,3,3,3,3 );
	  A2 = new Array (0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5 );
	  Mx = new Array (9,8,7,6,5,4,3,2,1,1);

	  if ( id.length != 10 ) return false;
	  i = tab.indexOf( id.charAt(0) );
	  if ( i == -1 ) return false;
	  sum = A1[i] + A2[i]*9;

	  for ( i=1; i<10; i++ ) {
	    v = parseInt( id.charAt(i) );
	    if ( isNaN(v) ) return false;
	    sum = sum + v * Mx[i];
	  }
	  if ( sum % 10 != 0 ) return false;
	  return true;
	}

function checkID(){
	var bossId = $.trim($('#bossId').val());
	var $radios = $('input:radio[name=idKind]');
	if (bossId.length==10){
		if (checkBossID(bossId)){
	        $radios.filter('[value=1]').prop('checked', true);
		}
		else{
			alert('身份證號欄位輸入錯誤');
		}
	}
	else{
		$radios.filter('[value=2]').prop('checked', true);
	}
}
function ccRegistData()
{
	var tag=true;
	var msg="";
	var mbName = $.trim($('#mbName').val());
	var bossId = $.trim($('#bossId').val());
	var birth = $.trim($('#birth').val());
	var tel1 = $.trim($('#tel1').val());
	var mtel = $.trim($('#mtel').val());
	var address2 = $.trim($('#address2').val());
	var trueIntroNo = $.trim($('#trueIntroNo').val());
	var trueIntroName = $.trim($('#trueIntroName').val());
	var acName = $.trim($('#acName').val());
	var giveMethod= $.trim($('#giveMethod').val());
	var giveMethodNo = $.trim($('#giveMethodNo').val());
	var bankAc = $.trim($('#bankAc').val());
	var ct=1;
	if (mbName.length==0){
		tag=false;
		msg=msg+ct+'.會員名稱不可空白;';
		ct=ct+1;
	}
	if (bossId.length==0){
		tag=false;
		msg=msg+ct+'.身份證號不可空白;';
		ct=ct+1;
	}
	else{
		if(bossId.length==10){
			if (!checkBossID(bossId)){
				tag=false;
				msg=msg+ct+'.身份證號格式錯誤;';
				ct=ct+1;
			}
		}
		else{
			if(bossId.length!=8){
				tag=false;
				msg=msg+ct+'.身份證號格式錯誤;';
				ct=ct+1;
			}
		}
	}
	if (birth.length==0){
		tag=false;
		msg=msg+ct+'.生日不可空白;';
		ct=ct+1;
	}
	else{
		if (!isValidDate(birth)){
			tag=false;
			msg=msg+ct+'.生日格式錯誤;';
			ct=ct+1;
		}
	}
	if (tel1.length==0){
		tag=false;
		msg=msg+ct+'.電話1不可空白;';
		ct=ct+1;
	}
	if (mtel.length==0){
		tag=false;
		msg=msg+ct+'.手機不可空白;';
		ct=ct+1;
	}
	if (address2.length==0){
		tag=false;
		msg=msg+ct+'.通訊地址不可空白;';
		ct=ct+1;
	}
	if (trueIntroNo.length==0){
		tag=false;
		msg=msg+ct+'.推薦人編號不可空白;';
		ct=ct+1;
	}
	if (trueIntroName.length==0){
		tag=false;
		msg=msg+ct+'.推薦人姓名不可空白;';
		ct=ct+1;
	}
	if (giveMethod.length==0){
		tag=false;
		msg=msg+ct+'.金融機構分行名稱不可空白;';
		ct=ct+1;
	}
	if (giveMethodNo.length==0){
		tag=false;
		msg=msg+ct+'.金融機構分行代號不可空白;';
		ct=ct+1;
	}
	if (bankAc.length==0){
		tag=false;
		msg=msg+ct+'.金融機構帳號不可空白;';
		ct=ct+1;
	}
	if (tag){
		var parameterStr = $('#mainForm').serialize();
		$.ajax({
	   		type: "POST",
	        url: defUrl+"ajax/checkRegist.php",
	        data: parameterStr,
	        dataType:'json',
	        success: function(data) {
	            if(data['code'] == 1){
	            	document.getElementById("mainForm").reset();
	            	var obj = jQuery.parseJSON(data['desc']);
	            	WebTool.webPageLocation(defUrl+"index.php?p1=tmpOrder&tmpMbNo="+obj.tmpMBNO);
	            }else{
					//alert(data['desc']);
					alert(data['desc']+';註冊資料有錯誤,請重新輸入');
	            }
	        },
	        error:function(xhr, ajaxOptions, thrownError){
	            alert(thrownError);
	 		}
	    });
	}
	else{
		alert(msg);
	}
    return;
}
</script>
<!-- 
<div class="header col-md-offset-2 col-md-10 control" >
	<h2><font face="標楷體">用户登錄</font></h2 >
</div>
 -->
 <div class="container">
 <div id="head_bg" align="center">
          <img src="/assets/images/logo.jpg" alt="xxx有限公司" id="logo" class="img-responsive">
 </div>
<div class="body">
<form class="form-horizontal"  role="form" id="mainForm" enctype="multipart/form-data" method="post">
	<h1 class="h3 mb-3 font-weight-normal"><font face="標楷體">XXX 用户註冊</font></h1>
    <h4>
    <div class="form-group col-md-6">
    	<label for "name" class="col-md-3 control-label" style="text-align: left"><font face="標楷體">會員姓名</font></label>
    	<div class="col-md-9">
	    	<input type="text" class="form-control input-lg" id="mbName" name="mbName" value="" placeholder="請輸入會員姓名">
    	</div>
    </div>
    <div class="form-group col-md-6">
    	<label for "id" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >身分證號</font></label>
    	<div class="col-md-9">
	    	<input type="text" class="form-control input-lg" id="bossId" onchange="checkID()" name="bossId" value="" placeholder="請輸入身分證號">
    	</div>
    </div>
    <div class="form-group col-md-6">
    	<label for "sex" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >性別</font></label>
    	<div class="col-md-9">
	    	<div class="radio">
  				<label><input type="radio" name="sex" value=1 checked="checked">男</label>
  				<label><input type="radio" name="sex" value=2>女</label>
			</div>
    	</div>
    </div>
    <div class="form-group col-md-6">
    	<label for "birth" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >生日</font></label>
    	<div class="col-md-9">
	    	<input class="form-control" type="date" value="2000-01-01" id="birth" name="birth">
    	</div>
    </div>
    <div class="form-group col-md-6">
    	<label for "pg_date" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >加入日期</font></label>
    	<div class="col-md-9">
	    	<input class="form-control" type="text" value="<?php echo date("Y/m/d");?>" id="pg_date" name="pg_date" readonly>
    	</div>
    </div>
    <div class="form-group col-md-6">
    	<label for "pg_yymm" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >加入年月</font></label>
    	<div class="col-md-9">
	    	<input class="form-control" type="text" value="<?php echo date("Ym");?>" id="pg_yymm" name="pg_yymm" readonly>
    	</div>
    </div>
    <div class="form-group col-md-6">
    	<label for "email" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >EMAIL</font></label>
    	<div class="col-md-9">
	    	<input type="email" class="form-control" id="inputEmail3" onchange="validateEmail()" placeholder="Email" name="email">
    	</div>
    </div>
    <div class="form-group col-md-6">
    	<label for "tel1" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >電話1</font></label>
    	<div class="col-md-9">
	    	<input class="form-control" type="tel" value="(02)9999-9999" id="tel1" name="tel1">
    	</div>
    </div>
    <div class="form-group col-md-6">
    	<label for "tel2" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >電話2</font></label>
    	<div class="col-md-9">
	    	<input class="form-control" type="tel" value="(02)9999-9999" id="tel2" name="tel2">
    	</div>
    </div>
    <div class="form-group col-md-6">
    	<label for "mtel" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >行動電話</font></label>
    	<div class="col-md-9">
	    	<input class="form-control" type="tel" value="0999-999-999" id="mtel" name="mtel">
    	</div>
    </div>
    <div class="form-group col-md-6">
    	<label for "faxNo" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >傳真電話</font></label>
    	<div class="col-md-9">
	    	<input class="form-control" type="tel" value="(02)9999-9999" id="faxNo" name="faxNo">
    	</div>
    </div>
    <div class="form-group col-md-6">
    	<label for "address1" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >戶籍地址</font></label>
    	<div class="col-md-9">
	    	<input class="form-control" type="text" value="" id="address1" name="address1" placeholder="請輸入戶籍地址">
    	</div>
    	<label for "post1" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >郵遞區號</font></label>
    	<div class="col-md-9">
	    	<input class="form-control" type="text" value="" id="post1" name="post1" placeholder="請輸入郵遞區號">
    	</div>
    </div>
    <div class="form-group col-md-6">
    	<label for "address2" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >通訊地址</font></label>
    	<div class="col-md-9">
	    	<input class="form-control" type="text" value="" id="address2" name="address2" placeholder="請輸入通訊地址">
    	</div>
    	<label for "post2" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >郵遞區號</font></label>
    	<div class="col-md-9">
	    	<input class="form-control" type="text" value="" id="post2" name="post2" placeholder="請輸入郵遞區號">
    	</div>
    </div>
    <div class="form-group col-md-6">
    	<label for "trueIntroNo" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >推薦人編號</font></label>
    	<div class="col-md-9">
	    	<input class="form-control" type="text" value="" id="trueIntroNo" name="trueIntroNo" placeholder="請輸入推薦人編號">
    	</div>	
    </div>
    <div class="form-group col-md-6">
    	<label for "trueIntroName" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >推薦人姓名</font></label>
    	<div class="col-md-9">
	    	<input class="form-control" type="text" value="" id="trueIntroName" name="trueIntroName" placeholder="請輸入推薦人全名或前兩個字">
	    	<input type="button" class="btn btn-info btn-lg" onclick="searchButton(1)" value="模糊查詢推薦人">
    	</div>	
    </div>
    <div class="form-group col-md-6">
    	<label for "acName" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >帳戶戶名</font></label>
    	<div class="col-md-9">
	    	<input class="form-control" type="text" value="" id="acName" name="acName" placeholder="請輸入帳戶戶名">
    	</div>	
    	<label for "likeMBNO" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >帳戶ID</font></label>
    	<div class="col-md-9">
	    	<input class="form-control" type="text" value="" id="likeMBNO" name="likeMBNO" placeholder="請輸入帳戶ID">
    	</div>
    	<label for "giveMethod" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >金融機構分行名稱</font></label>
    	<div class="col-md-9">
	    	<input class="form-control" type="text" value="" id="giveMethod" name="giveMethod" placeholder="請輸入部分金融機構名稱+空格+部分單位名稱">
	    	<input type="button" class="btn btn-info btn-lg" onclick="searchButton(2)" value="模糊查詢金融機構分行名稱">
    	</div>
    </div>
    <div class="form-group col-md-6">
    	<label for "giveMethodNo" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >金融機構分行代號</font></label>
    	<div class="col-md-9">
	    	<input class="form-control" type="text" value="" id="giveMethodNo" name="giveMethodNo" placeholder="請輸入金融機構分行代號">
    	</div>
    </div>
    <div class="form-group col-md-6">
    	<label for "bankAc" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >金融機構帳號</font></label>
    	<div class="col-md-9">
	    	<input class="form-control" type="text" value="" id="bankAc" name="bankAc" placeholder="請輸入金融機構分行代號">
    	</div>
    </div>
<!--     <div class="form-group col-md-6"> -->
<!--      	<label for "mbStatus" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >會員狀態</font></label> -->
<!--     	<div class="col-md-9"> -->
 	    	<input class="form-control" type="hidden" value="1" id="mbStatus" name="mbStatus"> 
<!--     	</div> -->
<!--     </div> -->
    <div class="form-group col-md-6">
    	<label for "idKind" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >身份別</font></label>
    	<div class="col-md-9">
	    	<div class="radio">
  				<label><input type="radio" name="idKind" value=1 checked="checked" readonly>自然人</label>
  				<label><input type="radio" name="idKind" value=2 readonly>法人</label>
			</div>
    	</div>
    </div>
<!--     <div class="form-group col-md-6"> -->
<!--      	<label for "gradeName" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >職級</font></label> -->
<!--     	<div class="col-md-9"> -->
    		<input class="form-control" type="hidden" value="1" id="gradeName" name="gradeName">
<!-- 	    	<select class="form-control" id="gradeName" name="gradeName"> -->
<!--     			<option>1</option> -->
<!--     			<option>2</option> -->
<!--     			<option>3</option> -->
<!--     			<option>4</option> -->
<!--   			</select> -->
<!--     	</div> -->
<!--     </div> -->
<!--     <div class="form-group col-md-6"> -->
<!--      	<label for "comefrom" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >入會途徑</font></label> -->
<!--     	<div class="col-md-9"> -->
<!-- 	    	<div class="radio"> -->
					<input class="form-control" type="hidden" value="1" id="comefrom" name="comefrom">
<!--   				<label><input type="radio" name="comefrom" value=1 checked="checked">網站入會</label> -->
<!--   				<label><input type="radio" name="comefrom" value=2>臨櫃入會</label> -->
<!-- 			</div> -->
<!--     	</div> -->
<!--     </div> -->
<!--     <div class="form-group col-md-6"> -->
<!--      	<label for "sendMethod" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >取貨方式</font></label> -->
<!--     	<div class="col-md-9"> -->
<!-- 	    	<div class="radio"> -->
 	    		<input class="form-control" type="hidden" value="1" id="sendMethod" name="sendMethod"> 
<!--   				<label><input type="radio" name="sendMethod" value=1 checked="checked">貨運</label> -->
<!--   				<label><input type="radio" name="sendMethod" value=2>自取</label> -->
<!-- 			</div> -->
<!--     	</div> -->
<!--     </div> -->
<!--     <div class="form-group col-md-6"> -->
<!--     	<label for “warehouse" class="col-md-3 control-label" style="text-align: left"><font face="標楷體" >取貨倉庫</font></label> -->
<!--     	<div class="col-md-9"> -->
<!-- 	    	<div class="radio"> -->
 	    	<input class="form-control" type="hidden" value="1" id="warehouse" name="warehouse">
<!--   				<label><input type="radio" name="warehouse" value=1 checked>W001:新北總公司</label> -->
<!-- 			</div> -->
<!--     	</div> -->
<!--     </div> -->
    <div class="form-group col-md-12">
	    <div class="col-md-6">
    	</div>
	    <div class="col-md-6">
	    	<input type="button" class="btn btn-info btn-lg" onClick="ccRegistData()" value="註冊">
	    </div>
    </div>
    </h4>
    
</form>
</div>
</div>
<?php 
require_once( __DIR__."/common/footer.php" );
?>
