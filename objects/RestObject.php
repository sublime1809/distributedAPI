<?php

class RestObject {
    
    public $id;
    private $tablename;
    
    function __construct($tablename) {
        $this->tablename = $tablename;
    }
    
    // GET
    static function find($id) {
        return get_called_class() . ' : ' . $id;
    }
    // PUT
    function update($arrayOfValues) {
        
    }
    // POST
    static function create($arrayOfValues) {
        $className = get_called_class();
        $obj = new $className();
        $newVars = get_object_vars($arrayOfValues);
        $vars = get_class_vars($className);
        print_r($newVars);
        print_r($vars);
        foreach(array_keys($newVars) as $var) {
            if(in_array($var, array_keys($vars))) {
                echo "setting: " . $var . ' to ' . $arrayOfValues->$var;
                $obj->$var = $arrayOfValues->$var;
            }
        }
        // TODO save to DB
        return $obj;
    }
    // DELETE
    static function delete($id) {
        
    }
    
    private function save() {
        
    }
}
