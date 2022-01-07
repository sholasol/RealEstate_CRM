<?php
class DB {
    private static $_instance = null;
    private $_pdo, 
            $_query,
            $_error = false, 
            $_results,
            $_count = 0;
    private function __construct(){
        
        try{
            $this->_pdo = new PDO('mysql:host='.Config::get('mysql/host') .'; dbname='. Config::get('mysql/db') , Config::get('mysql/username'), Config::get('mysql/password'));
            //echo 'connected';
        } catch (PDOException $e) {
            die($e ->getMessage());
        }
    }
    //Setting database instance
    //This checks wheter the instance had been set 
    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new DB();
        }
        return self::$_instance;
    }
    
    public function query($sql, $params = array()){
        $this->_error = false;  
        if($this->_query =$this ->_pdo->prepare($sql)){
           $x =1;
            if(count($params)){
                foreach($params as $param){
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            
            if($this->_query->execute()){
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count= $this->_query->rowCount();
            }else{
                $this->_error =true;
            }
          
        }
        return $this;
    }
    
    //private function action($action, $table, $where = array()){
    public function action($action, $table, $where = array()){
      if(count($where)=== 3){
          $operators = array('=', '>', '<' ,'>=', '<=');
          
          $field       =   $where[0];
          $operator    =   $where[1];
          $value       =   $where[2];
          
          if(in_array($operator, $operators)){
              //"SELECT * FROM users WHERE username='Alex'
              $sql = "{$action}  FROM {$table} WHERE {$field} {$operator} ?";
              //if the query runs successfully
              if(!$this->query($sql, array($value))->error()){
                 return $this; 
              }
          }
      }
      //If the query doesnt run
      return false;
    }
    
    public function get($table, $where){
        $array = array();
       return $this->action('SELECT * ', $table, $where); 
    }
    
//    public function multiSelect($table, $where){
//        return $this->action('SELECT * ', $table, $where);
//    }
    
    public function delete(){
        return $this->action('DELETE ', $table, $where); 
    }
    
    
    //Insert and update records into a database that already exist.
    public function insert($table, $fields = array())
    {
        // if(count($fields)) {
            $keys = array_keys($fields);
            $values = '';
            $x = 1; //counter to use

            //values to assign, here we just want a list of question marks.
            foreach($fields as $field) {
                $values .= '?';
                if($x < count($fields)) {
                    $values .= ', ';
                }
                $x++;
            }

            $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";
            //the fields to insert into
            // the line above on-implode will take the keys we're are working with and seperate them with a seperator.

            if(!$this->query($sql, $fields)->error()) {
                return true;
            }
        // } 
        return false;
    }
    
    
    
    //Updating record
    public function update($table, $id, $fields){
        $set = '';
        $x = 1;
        
        foreach($fields as $name => $value){
            $set .="{$name} = ?"; 
            if($x < count($fields)){
                $set .= ', ';
            }
            $x++;
        }
        
        
        //$sql ="UPDATE users SET password = 'newpassowrd' WHERE id = 3";
        $sql = "UPDATE {$table} SET {$set} WHERE id ={$id}";
        
        if(!$this->query($sql, $fields)->error()){
            return true;
        }
        return false;
    }
    
    
    
    //Fetching multiple result
    public function results(){
        return $this->_results;
    }
    
    //Fetching first result
    public function first(){
        return $this->results()[0];
    }
    
    public function error(){
        return $this->_error;
    }
    
    public function count(){
        return $this->_count; 
    }
}

