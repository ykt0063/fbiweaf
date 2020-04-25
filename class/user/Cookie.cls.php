<?php
namespace report\user;


class Cookie{
	public static function set($cookie_name,$cookie_value,$expireTime=0){
		if ($expireTime!=0){
			$cookie_value= $cookie_value."|".$expireTime;
			setcookie($cookie_name,$cookie_value,$expireTime);
		}
		else{
			setcookie($cookie_name,$cookie_value);
		}
	}
	
	public static function get($cookie_name){
		if (isset($_COOKIE[$cookie_name])){
			return $_COOKIE[$cookie_name];
		}
		else{
			return FALSE;
		}
	}
	
	public static function clear($cookie_name){
		unset($_COOKIE[$cookie_name]);
		setcookie($cookie_name, null, -1);
	}
	
	public static function check($cookie_name){
		if (isset($_COOKIE[$cookie_name]))
			return true;
		else
			return false;
	}
	
	public static function expireTime($cookie_name){
		if (isset($_COOKIE[$coolie_name])){
			return explode("|", $_COOKIE($coolie_name));
		}
		else
			return array("",-1);
	}
}
?>