<?php

class Cookie{
    
    public static function exists($name){
        return (isset($_COOKIE[$name])) ? true : false;
    }
    
    public static function get($name){
        return $_COOKIE[$name];
    }
    
    //setting cooking by passing cookie name, value and current time plus expiry time with the current path of the application
    public static function put($name, $value, $expiry){
        if(setcookie($name, $value, time() + $expiry, '/')){
           return true; 
        }
        return false;
        
    }

        
    public static function delete($name){
      //deleting cookie 
      self::put($name, '', time() - 1);
    }
    
}

