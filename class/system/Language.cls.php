<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace report\system;

use report\user\Session;

class Language 
{
    /*
     * 取得指定的翻譯字
     */
    public static function get($key)
    {
        global $languageCode;
        
        if(isset($languageCode[$key])){
            return $languageCode[$key];
        }
        
        return '';
    }
}