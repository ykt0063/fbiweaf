<?php
  namespace report\response;
  use report\base\Json;
  use report\system\Language;
  class ReturnHandler{
  	public static function response( $code, $parAry = null, $msg = '' )
  	{
  		$retObj = self::responseObj($code, $parAry);
  		if( !empty($msg) )
  			$retObj['desc'] .= $msg;
  			
  			echo Json::encode($retObj);
  			exit();
  	}
  	
  	public static function responseObj( $code, $parAry = null, $msg = '', $replaceCodeDescAry = null )
  	{
  		$retObj = array();
  		$retObj['code'] = $code;
  		$retObj['desc'] = Language::get($code);
  		
  		if( $replaceCodeDescAry != null ){
  			foreach( $replaceCodeDescAry as $key => $value )
  			{
  				$retObj['desc'] = str_replace("{".$key."}", $value, $retObj['desc']);
  			}
  			unset($key);
  			unset($value);
  		}
  		
  		if( !empty($msg) )
  			$retObj['desc'] .= $msg;
  			
  			if( $parAry != null ){
  				foreach( $parAry as $index => $value )
  				{
  					$retObj[$index] = $value;
  				}
  				unset($index);
  				unset($value);
  			}
  			
  			return $retObj;
  	}
  }
?>
