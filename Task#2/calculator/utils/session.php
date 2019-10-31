<?php
session_start();

class Session{

    public static function setValue($fieldName, $value){
        $_SESSION[$fieldName] = $value;
    }

    public static function haveValue($fieldName){
       return isset($_SESSION[$fieldName]);
    }

    public static function getValue($fieldName){
        return $_SESSION[$fieldName];
    }

    public static function clear($fieldName){
        unset($_SESSION[$fieldName]);
    }
}

?>