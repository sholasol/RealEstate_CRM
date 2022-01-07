<?php

class Map {
    private $id;
    private $name;
    private $address;
    private $type;
    private $lat;
    private $lng;
    private $_db;
    private $_data;
    
    function setId($id){$this->id = $id;}
    function getId(){return $this->id;}
    function setName($name){$this->name = $name;}
    function getName(){return $this->name;}
    function setAddress($address){$this->address = $address;}
    function getAddress(){return $this->address;}
    function setType($type){$this->type = $type;}
    function getType(){return $this->type;}
    function setLat($lat){$this->lat = $lat;}
    function getLat(){return $this->lat;}
    function setLng($lng){$this->lng = $lng;}
    function getLng(){return $this->lng;}
      
    
    public function __construct(){
        $this->_db =DB::getInstance() ;
    }
    
    public function updateMap($fields = array(), $id= null){
        $id = $this->data()->id;
        if(!$this->_db->update('map', $id, $fields)){
            throw new Exception('There was a problem updating the map address');
        }
    }
    
    
    
    public function createLatLng($fields =array()){
        if(!$this->_db->insert('map', $fields)){
           throw new Exception('There was a problem creating an account');
        }
    }
    
    //Checking if the user actually exists
    public function find($map = null){
        if($map){
            
            $field = (is_numeric($map)) ? 'id' : 'name' ;
            $data = $this->_db->get('map', array($field, '=', $map));
            
            if($data->count()){
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }
    
    
    
    public function exists(){
        return (!empty($this->_data)) ? true : false;
    }
    
    //function to return user data
    public function data(){
        return $this->_data;
    }
    
    
    
}
