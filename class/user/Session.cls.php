<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace report\user;

class Session {

    /*
     * 寫入SESSION
     */
    public static function save($obj = array())
    {
        foreach($obj as $key => $val){
            $_SESSION[$key] = $val;
        }
    }

    /*
     * 取得SESSION
     */
    public static function get($key = '')
    {
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }

        return FALSE;
    }

    /*
     * 清空session
     */
    public static function deleteAll()
    {
        session_destroy();
    }

    public static function dumpAll(){
        echo '<pre>';
        var_dump($_SESSION);
        echo '</pre>'; 
    }
    
    public static function delete($key){
        if(isset($_SESSION[$key])){
            unset ($_SESSION[$key]);
        }
    }
}
