<?php

class RestObject {
    
    public $id;
    private $tablename;
    
    function __construct($tablename) {
        $this->tablename = $tablename;
    }
    
    // GET
    function find($id) {
        $conn = $this->getConnection();
        mysqli_query($conn, "SELECT * FROM ");
        return get_called_class() . ' : ' . $id;
    }
    // PUT
    function update($id, $arrayOfValues) {
        $this->find($id);
        $className = get_called_class();
        $newVars = get_object_vars($arrayOfValues);
        $vars = get_class_vars($className);
        foreach(array_keys($newVars) as $var) {
            if(in_array($var, array_keys($vars))) {
                $this->$var = $arrayOfValues->$var;
            }
        }
        // TODO save to DB
        return $this;
    }
    // POST
    function create($arrayOfValues) {
        $className = get_called_class();
        $newVars = get_object_vars($arrayOfValues);
        $vars = get_class_vars($className);
        foreach(array_keys($newVars) as $var) {
            if(in_array($var, array_keys($vars))) {
                $this->$var = $arrayOfValues->$var;
            }
        }
        // TODO save to DB
        return $this;
    }
    // DELETE
    function delete($id) {
        
    }
    
    private function save() {
        
    }
    
    static function getConnection() {
        $config = json_decode(file_get_contents('config.json'));
        
        $host = $config->database->host;
        $user = $config->database->user;
        $password = $config->database->password;
        $database = $config->database->database;

        return mysqli_connect($host, $user, $password, $database);
    }
}
