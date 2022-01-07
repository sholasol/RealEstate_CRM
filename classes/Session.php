<?php

class Session{
    //checking if token exists
    public static function exists($name){
        return (isset($_SESSION[$name])) ? true : false;
    }
    //getting token value
    public static function put($name, $value){
        return $_SESSION[$name] = $value;
    }
    
    public static function get($name){
        return $_SESSION[$name];
    }

    //delete token
    public static function delete($name){
       if(self::exists($name)){
           unset($_SESSION[$name]);
       } 
    }
    // function to show flash message
    public static function flash($name, $string =''){
        if(self::exists($name)){
            $session = self::get($name);
            self::delete($name);
            return $session;
        }else{
            self::put($name, $string);
        }
        //return '';
    }
}

