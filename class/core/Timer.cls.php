<?php

/**
 * 計算執行時間
 */
namespace core\tool;

class Timer {
    
    private static $instance;
    
    private $timestart; 
    private $digits; 

    public function __construct($digits = "")
    {
        $this->digits = $digits; 
        self::$instance =& $this;
    }
    
    public static function &get_instance()
    {
        return self::$instance;
    }
    
    /**開始計時*/
    public function start() 
    { 
        $this->timestart = explode (' ', microtime()); 
    } 
    
    /**取得已執行時間*/
    public function totaltime() 
    { 
        if(empty($this->timestart)){
            return -1;
        }
        
        $timefinish = explode (' ', microtime()); 
        if($this->digits == ""){ 
            $runtime_float = $timefinish[0] - $this->timestart[0]; 
        }else{ 
            $runtime_float = round(($timefinish[0] - $this->timestart[0]), $this->digits); 
        } 
        $runtime = ($timefinish[1] - $this->timestart[1]) + $runtime_float; 
        return $runtime; 
    }
    
    public function getStartTime() 
    { 
        if (!empty($this->timestart[0]) && !empty($this->timestart[1])) {
            return date('Y-m-d H:i:s',$this->timestart[1]).$this->timestart[0];
        }
        return ''; 
    } 
}

