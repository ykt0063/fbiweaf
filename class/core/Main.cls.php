<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m
 *
 * @author Arthur
 */
namespace core\main;

use core\db\PdoDb;

class Main {
    //public static $redis;//redis物件
    
    //public static $mongo;//mongodb物件
    
    public static $mysql;//mysql物件
    
    private static $pdo;//pdo物件
    
    public static $timer;//timer物件
    
    public static $apiPathAry;//記錄本次呼叫api
    
    //公司內部IP陣列
    public static $debugIPAry = array('192.168.0.16','');
            
    function __construct( ){
        
    }
    
    /**取得資料庫物件*/
    public static function getDBObj() 
    {
        if (static::$pdo == null) {
            static::$pdo = new PdoDb( MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_NAME );

        } else if (!static::$pdo->isConnected()) {
            static::$pdo = new PdoDb( MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_NAME );
        }

        return static::$pdo;
    }
}
