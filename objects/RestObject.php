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
        foreach(array_keys($newVars) as $var) {
            if(in_array($var, array_keys($vars))) {
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
    
    static function getConnection() {
        $config = json_decode(file_get_contents('config.json'));
        
        print_r($config);
        $host = $config->database->host;
        $user = $config->database->user;
        $password = $config->database->password;
        $database = $config->database->database;

        return mysqli_connect($host, $user, $password, $database);
    }
}
