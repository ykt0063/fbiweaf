<?php

namespace core\tool;

class Json {
    /**
     * Json編碼
     *
     * @param mixed $value 需要編碼的陣列或是物件
     */
    public static function encode( $value )
    {
        return json_encode($value,JSON_UNESCAPED_UNICODE);
    }
    /**
     * Json編碼
     *
     * @param mixed $value 需要解碼的陣列或是物件
     */
    public static function decode( $jsonStr )
    {
        return json_decode($jsonStr,true);
    }
}
