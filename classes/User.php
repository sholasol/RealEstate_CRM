<?php

class User {
    private $_db,
            $_data,
            $_sessionName,
            $_cookieName,
            $_isLoggedIn;




    public function __construct($user= null ) {
       $this->_db =DB::getInstance() ;
       
       //Retrieving user session
       $this->_sessionName = Config::get('session/session_name');
       //setting cookie
       $this->_cookieName = Config::get('remember/cookie_name');
       
       //checking if user exists
       if(!$user){
           if(Session::exists($this->_sessionName)){
               $user = Session::get($this->_sessionName);
               
               if($this->find($user)){
                   $this->_isLoggedIn = true;
               }else{
                   //Process Logout
                   
               }
           }
       }else{
           $this->find($user);
       }
    }
    
    //This method is to update user's personal detail and not an admin updating other users
    public function update($fields = array(), $id= null){
        //getiing the user id
        if(!$id && $this->isLoogedIn()){
            $id = $this->data()->id;
        }
        //performing the update
        if(!$this->_db->update('users', $id, $fields)){
            throw new Exception('There was a problem updating the user');
        }
        
    }
    
    public function create($fields =array()){
        if(!$this->_db->insert('users', $fields)){
           throw new Exception('There was a problem creating an account');
        }
    }
    public function createCons($fields =array()){
        if(!$this->_db->insert('consultants', $fields)){
           throw new Exception('There was a problem creating the consultant');
        }
    }
  
    public function createClaim($fields =array()){
        if(!$this->_db->insert('claim', $fields)){
           throw new Exception('There was a problem process the claim');
        }
    }
   
    
    //Checking if the user actually exists
    public function find($user = null){
        if($user){
            
            $field = (is_numeric($user)) ? 'id' : 'email' ;
            $data = $this->_db->get('users', array($field, '=', $user));
            
            if($data->count()){
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }
    
    //function to log user in
    public function login($email = null, $password = null, $remember = false){
        
        //print_r($this->_data); this returns all user's information
        
        if(!$email && !$password && $this->exists()){
         //log the user in 
            Session::put($this->_sessionName, $this->data()->id);
        }else{
            $user = $this->find($email);
        
        
        if($user){
            //checking if username and password matches information supplied by user
            if($this->data()->password === Hash::make($password, $this->data()->salt)){
                //Storing user id in the session variable
                Session::put($this->_sessionName, $this->data()->id);
                //checking if remember me box is clicked
                if($remember){
                    //generating unique hash
                  $hash = Hash::unique();
                  //check if hash is in the database
                  $hashCheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->id)); 
                  if(!$hashCheck->count()){
                      $this->_db->insert('users_session', array(
                          //Put this record in the session database
                          'user_id' => $this->data()->id,
                          'hash'    => $hash
                      ));
                  }else{
                      $hash = $hashCheck->first()->hash;
                  }
                  
                  Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
                }
                //recording user login activity
                $this->_db->insert('activity', array(
                    //Put this record in the session database
                    'user' => $this->data()->email,
                    'activity'    => 'User login'
                ));
                
                return true;
            }
            
        }
        
     }
     return false;
     
    }
    
    public function hasPermission($key){
        //grab user group data from group table 
        $group = $this->_db->get('groups', array('id', '=', $this->data()->group));
        
        if($group->count()){
            //get the permission from the group table
            $permissions = json_decode($group->first()->permission, true);
            
            if($permissions[$key] == true){
                return true;
            }
            
        }
        return false;
    }
    
    
    
 
    
    public function exists(){
        return (!empty($this->_data)) ? true : false;
    }
    
    //logout method
    public function logout(){
        $this->_db->delete('users_session', array('user_id', '=', $this->data()->id));
        
        Session::delete($this->_sessionName);
        //removing the hash from browser
        Cookie::delete($this->_cookieName);
        
        //recording user login activity
        $this->_db->insert('activity', array(
            //Put this record in the session database
            'user' => $this->data()->email,
            'activity'    => 'User logout'
        ));
    }
    
    //function to return user data
    public function data(){
        return $this->_data;
    }
    
    public function isLoogedIn(){
        return $this->_isLoggedIn;
    }
    
    
    
}

