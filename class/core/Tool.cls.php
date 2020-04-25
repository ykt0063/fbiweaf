<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of logHandler
 *
 * @author Arthur
 */
namespace core\tool;


use core\main\Main;

class Tool {
    private static $_runTime = 0;
    private static $_catchTableAry = array();

    public static function syslog( $string, $fileName = '', $path = '' )
    {
        if(empty($path))
            $path = LOG_PATH;

        if( empty($fileName) )
            $fileName = date('YmdH').'.log';
        else
            $fileName = $fileName."_".date('YmdH').'.log';

        if (strlen($string) > 700) {
            $string = substr($string, 0, 700).".....";
        }

        @error_log(Main::$timer->getStartTime()." ".$string."\r\n", 3, $path.$fileName);

        if (substr(sprintf('%o', fileperms($path.$fileName)), -4) != '0666') {
            chmod($path.$fileName, 0666);
        }

        self::syslogToDB($string);
    }

    private static function syslogToDB($string)
    {
        //需要紀錄到DB的api log
        $logAry = array(
            'cmd=payment/withdrawApply' => '发起提现',
            'cmd=withdrawApply'         => '发起提现',
        );

        $action = "";
        foreach($logAry as $cmd => $desc) {
            if (strpos($string, $cmd) !== false) {
               $action = $desc;
               break;
            }
        }
        if (empty($action)) {
            return;
        }

        $table = "`sa_api_log`.`nigger_log`";
        $request_time = Main::$timer->getStartTime();

        //輸入參數
        if (strpos($string, "request=") !== false) {

            $insertAry = array(
                'action' => $action,
                'request' => self::substr_after($string,"request="),
                'ctime' => $request_time
            );

            return Main::getDBObj()->sql_ignore_insert($table, $insertAry);
        }

        //輸出結果
        if (strpos($string, "response=") !== false) {

            $confition = "AND `ctime` = ?";

            $response = self::substr_after($string,"response=");
            $response = self::substr_before($response,"api time=");
            $response = trim($response);

            $updateAry = array(
                'response' => $response,
            );

            return Main::getDBObj()->sql_update($table, $updateAry, $confition, array($request_time));
        }
    }

    public static function runtimeStart()
    {
        self::$_runTime = microtime(true);
    }

    public static function runtimeEnd()
    {
        $time_end = microtime(true);

        $time = $time_end - self::$_runTime;
        self::$_runTime = 0;

        return $time;
    }

    /**
     * 取得Client端IP
     *
     * @return String ipAddress Client IP
     */
    public static function getClientIp() {
        $ipAddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipAddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipAddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipAddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipAddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipAddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipAddress = getenv('REMOTE_ADDR');
        else
            $ipAddress = 'UNKNOWN';

        $ipAry = explode(",", $ipAddress);
        if( count($ipAry) > 1 )
            $ipAddress = trim($ipAry[0]);

        return $ipAddress;
    }

    /*
     * 移除空值的陣列
     */
    public static function removeNullArray( $ary )
    {
        $retAry = array();
        foreach( $ary as $index => $value )
        {
            if( !empty($value) || $value === 0 || $value === "0")
                $retAry[] = $value;

        }
        return $retAry;
    }
    /*
     * 將索引值改成陣列的某個值
     * ary:需要處理的陣列
     * _index:當作索引的該陣列某索引名稱
     */
    public static function setArrayByIndex( $ary, $_index )
    {
        $tmpAry = array();
        foreach( $ary as $index => $value )
        {
            $tmpAry[$ary[$index][$_index]] = $ary[$index];
        }
        return $tmpAry;
    }
    /*
     * 將索引值改成陣列的某個值(雙索引)
     * ary:需要處理的陣列
     * _index_1:當作索引的該陣列某索引名稱
     * _index_ㄉ:當作索引的該陣列某索引名稱
     */
    public static function setArrayByDoubleIndex( $ary, $_index_1, $_index_2 )
    {
        $tmpAry = array();
        foreach( $ary as $index => $value )
        {
            $tmpAry[$ary[$index][$_index_1]."_".$ary[$index][$_index_2]] = $ary[$index];
        }
        return $tmpAry;
    }
    /*
     * 搜尋某一個process
     */
    public static function findProcess($cmd, $count = 1)
    {
        $str = '';
        if( ($hp = popen("ps -axo command","r")) !== false )
        {
            while( ($ln=fgets($hp)) !== false )
            {
                $str .= $ln;
            }
            pclose($hp);
        }
        $str = str_replace("\n", "", $str);

        //搜尋是否有關鍵字
        if( substr_count($str, $cmd) > $count ){
            return true;
        }else{
            return false;
        }
    }
    /*
     * 將數字轉為餘額格式
     */
    public static function numberToCNPrice( $num )
    {
        return floatval(number_format($num, 2, '.', ''));
    }
    /*
     * 搜尋某一個process
     */
    public static function getProcessCommand()
    {
        $str = '';
        if( ($hp = popen("ps -axo command","r")) !== false )
        {
            while( ($ln=fgets($hp)) !== false )
            {
                $str .= $ln;
            }
            pclose($hp);
        }
        $str = str_replace("\n", "", $str);
        return $str;
    }

    /*
     * 產生一個md5編碼過的純數字
     */
    public static function md5_hex_to_dec($hex_str)
    {
        if( empty($hex_str) )
            return 0;
        $hex='';
        for ($i=0; $i < strlen($hex_str); $i++){
            $hex .= ord($hex_str[$i]);
        }
        return intval(substr($hex,-5));
    }

    /*
     * 產生資料庫 table
     */
    public static function createDBTable( $sourceTable, $targetTable )
    {
        if( isset(self::$_catchTableAry[$targetTable]) )
            return;

        self::$_catchTableAry[$targetTable] = 1;

        $sqlstr = "CREATE TABLE ".$targetTable." LIKE ".$sourceTable.";";

        $result = Main::$mysql->sql_query($sqlstr);
    }

    /*
     * 取出標籤格式字串中某一個屬性值
     * str:整個字串
     * attributeName:需要取值的屬性名稱
     */
    public static function getTagAttributeValue( $str, $attributeName )
    {
        $str = substr($str,strpos($str,$attributeName.'="')+  strlen($attributeName.'="'));

        $str = substr($str,0,strpos($str,'"'));

        return $str;
    }

    public static function eat($variable_name, $chk_empty=true, $valid_fun="", $category="request")
    {
        $value = null;
        switch(strtolower($category))
        {
            case 'post':
                if(isset($_POST[$variable_name])){
                    if($_POST[$variable_name] != ''){
                        $value = $_POST[$variable_name];
                    }
                }
            break;
            case 'get':
                if(isset($_GET[$variable_name])){
                    if($_GET[$variable_name] != ''){
                        $value = $_GET[$variable_name];
                    }
                }
            break;
            case 'request':
                if(isset($_REQUEST[$variable_name])){
                    if($_REQUEST[$variable_name] != ''){
                        $value = $_REQUEST[$variable_name];
                    }
                }
            break;
            default:
                //die("不合法的 category：$category");
                throw new \Exception("不合法的 category：$category");
            break;
        }

        if( $chk_empty && isset($value) == false )
        {
            die("錯誤：偵測到參數 $variable_name 為空");
        }

        if(isset($value) == true)
        {
            if($valid_fun)
            {
                if(!call_user_func($valid_fun, $value))
                {
                    //die("錯誤：偵測到參數 $variable_name 格式有誤");
                    throw new \Exception("錯誤：偵測到參數 $variable_name 格式有誤");
                }
            }
            else
            {
                $value = trim($value);
                $value = self::remove_ctrl($value);
                $value = htmlspecialchars($value, ENT_QUOTES);
                $value = filter_var($value, FILTER_SANITIZE_STRING);
            }
        }
        return $value;
    }
    public static function remove_ctrl($var)
    {
        return preg_replace("/[\x-\x1f]/", "", $var);
    }

    public static function CreateSN ($userid, $subnet = '', $act ='')
    {

        return $subnet . strtoupper(base_convert($userid, 16, 36) .
                base_convert (self::getDatewithMicro (), 16, 36 )).
               str_pad(getmypid ()%  100, 2, '0', STR_PAD_LEFT) . $act ;

    }
    public static function getDatewithMicro()
    {
        //return date ( "YmdHis"). str_pad(microtime(true)* 1000 % 1000, 3, '0', STR_PAD_LEFT)  ;//bug!!

        $microtime = microtime(true);

        return date('YmdHis', $microtime).str_pad($microtime* 1000 % 1000, 3, '0', STR_PAD_LEFT);
    }

    /**
      * 從目標字串產生隨機字串
      * @param string $target_word 目標字串
      * @param string $lenth 長度
      */
     public static function randStr($target_word, $lenth)
     {
        $str = '';
        $len = strlen( $target_word);
        for ($i = 0; $i < $lenth; $i++) {
                $str .= $target_word[rand() % $len];
        }
        return $str;
    }

    /*
     * 無條件進位到小數某一位
     * @param int v 浮點數
     * @param int precision 小數第幾位
     */
    public static function ceil_dec($v, $precision)
    {
        $c = pow(10, $precision);
        return ceil($v*$c)/$c;
    }
    /*
     * 無條件捨去到小數某一位
     * @param int v 浮點數
     * @param int precision 小數第幾位
     */
    public static function floor_dec($v, $precision)
    {
        $c = pow(10, $precision);
        return floor($v*$c)/$c;
    }

    public static function float_add($float1, $float2)
    {
        $float1 = ($float1 * 10000);
        $float2 = ($float2 * 10000);

        return ($float1+$float2)/10000;
    }

    public static function float_sub($float1, $float2)
    {
        $float1 = ($float1 * 10000);
        $float2 = ($float2 * 10000);

        return ($float1-$float2)/10000;
    }

    public static function float_mul($float1, $float2, int $scale = 2)
    {
        $float1 = ($float1 * 10000);
        $float2 = ($float2 * 10000);
        $result = ($float1*$float2)/100000000;

        $pos = strpos($result, '.');
        if ($pos !== false) {
            $resultAry = explode('.',$result);
            $result = $resultAry[0].'.'.substr($resultAry[1], 0, $scale);
        }

        return $result;
    }

    /*
     * 結合兩個陣列
     * ary1:第一個陣列
     * ary2:第二個陣列
     */
    public static function array_combine($ary1, $ary2)
    {
        if( is_array($ary1) && is_array($ary2) )
        {
            foreach( $ary2 as $index => $value )
                $ary1[$index] = $value;
        }else if( is_array($ary2) )
            return $ary2;

        return $ary1;
    }

    //抓取以周為切割時間磋計
    public static function getWeekUnixTime( $timeStr )
    {
        //先轉換時間磋技
        $tmpTime = strtotime($timeStr);
        //將時間調整到當週的禮拜一
        $tmpTimeInfo = getdate($tmpTime);
        $wday = $tmpTimeInfo['wday'] - 1;
        if( $wday >= 0 )
            $tmpTime = $tmpTime - ($wday*86400);
        else
            $tmpTime = $tmpTime - (6*86400);

        return $tmpTime;
    }

    /*
     * 確認目標IP與設定IP是否相符
     * targetIP:目標IP
     * $checkIPArr:已設定的IP陣列
     */
    public static function checkIPAuth( $targetIP, $checkIPArr ){

        if( in_array($targetIP,$checkIPArr)) {
            return TRUE;
        }

        $targetIpAry = explode(".",$targetIP);

        if( $targetIpAry[0] == '192' || $targetIpAry[0] == '172' || $targetIpAry[0] == '10' )
            return TRUE;

        //判斷是否有*號的設定
        foreach( $checkIPArr as $value )
        {
            $tmpIpAry = explode(".",$value);
            if( ($tmpIpAry[1] == '*' || $tmpIpAry[2] == '*' || $tmpIpAry[3] == '*') && $targetIpAry[0] == $tmpIpAry[0] ){

                if( $tmpIpAry[1] == '*' )
                    return TRUE;
                else if( $tmpIpAry[1] == $targetIpAry[1] && $tmpIpAry[2] == '*' )
                    return TRUE;
                else if( $tmpIpAry[1] == $targetIpAry[1] && $tmpIpAry[2] == $targetIpAry[2] )
                    return TRUE;

            }
        }

        return FALSE;
    }

    /*
     * 確認是否為公司IP
     */
    public static function checkInternalIP(){

//        return self::checkIPAuth(self::getClientIp(), SystemConfig::$officialIPArr);

    }

    /*
     * 本日剩餘秒數
     */
    public static function getDayRemainingSec(){
        return strtotime(date('Y-m-d 23:59:59')) - time();
    }

    /**
     * 取得某文字之前的內容
     * @param string $content 原內容
     * @param string $target 目標文字
     //* @param bolean $exclude_target 取得內容排除該文字
     */
    public static function substr_before($content, $target, $exclude_target=true)
    {
        $pos = strpos($content, $target);

        if ($pos === false) return '';

        if (!$exclude_target) {
            $pos += strlen($target);
        }

        $content = substr($content, 0, $pos);

        return $content;
    }

    /**
     * 取得某文字之後的內容
     * @param string $content 原內容
     * @param string $target 目標文字
    //* @param bolean $exclude_target 取得內容排除該文字
     */
    public static function substr_after($content, $target, $exclude_target=true)
    {
        $pos = strpos($content, $target);

        if ($pos === false) return '';

        if ($exclude_target) {
            $pos += strlen($target);
        }

        $content = substr($content, $pos);

        return $content;
    }


	/**
	 * json 字串格式化
	 * @param      $json
	 * @param bool $html ：html格式
	 * @return string
	 */
	public static function format_json($json, $html = false) {
		$tabcount = 0;
		$result = '';
		$inquote = false;
		$ignorenext = false;
		if ($html) {
			$tab = "&nbsp;&nbsp;&nbsp;";
			$newline = "<br/>";
		} else {
			$tab = "\t";
			$newline = "\n";
		}
		for($i = 0; $i < strlen($json); $i++) {
			$char = $json[$i];
			if ($ignorenext) {
				$result .= $char;
				$ignorenext = false;
			} else {
				switch($char) {
					case '{':
						$tabcount++;
						$result .= $char . $newline . str_repeat($tab, $tabcount);
						break;
					case '}':
						$tabcount--;
						$result = trim($result) . $newline . str_repeat($tab, $tabcount) . $char;
						break;
					case ',':
						$result .= $char . $newline . str_repeat($tab, $tabcount);
						break;
					case '"':
						$inquote = !$inquote;
						$result .= $char;
						break;
					case '\\':
						if ($inquote) $ignorenext = true;
						$result .= $char;
						break;
					default:
						$result .= $char;
				}
			}
		}
		return $result;
	}

}
