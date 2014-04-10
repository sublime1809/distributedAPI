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

        $result = mysqli_query($conn, "SELECT * FROM $this->tablename WHERE id=$this->id LIMIT 1");
        if($result) {
            $values = mysqli_fetch_assoc($result);
            $vars = get_class_vars(get_called_class());
            foreach(array_keys($values) as $var) {
                if(in_array($var, array_keys($vars))) {
                    $this->$var = $values->$var;
                }
            }
        }
        return $this;
    }
    static function findBy($values) {
        $conn = $this->getConnection();

        $className = get_called_class();
        $vars = get_class_vars($className);
        $columns = array();
        foreach(array_keys($values) as $var) {
            if(in_array($var, array_keys($vars))) {
                $value = mysql_real_escape_string($values[$var]);
                $columns[] = "$var=$value";
            }
        }
        
        $result = mysqli_query($conn, "SELECT * FROM $this->tablename WHERE " . implode(',', $columns));
        if($result) {
            $objects = array();
            while($values = mysqli_fetch_assoc($result)) {
                $object = new $className;
                foreach(array_keys($values) as $var) {
                    if(in_array($var, array_keys($vars))) {
                        $object->$var = $values->$var;
                    }
                }
                $objects[] = $object;
            }
        }
        return $objects;
    }
    // PUT
    function update($id, $arrayOfValues) {
        $this->find($id);
        $className = get_called_class();
        $newVars = get_object_vars($arrayOfValues);
        $vars = get_class_vars($className);
        $columns = array();
        
        foreach(array_keys($newVars) as $var) {
            if(in_array($var, array_keys($vars))) {
                $this->$var = mysql_real_escape_string($arrayOfValues->$var);
                $columns[] = "$var=$this->$var";
            }
        }
        $conn = getConnection();
        
        mysqli_query($conn, "UPDATE $this->tablename SET " . implode(',', $columns) . " WHERE id=$this->id LIMIT 1");
        return $this;
    }
    // POST
    function create($arrayOfValues) {
        $className = get_called_class();
        $newVars = get_object_vars($arrayOfValues);
        $vars = get_class_vars($className);
        $columns = array();
        $columnValues = array();
        foreach(array_keys($newVars) as $var) {
            if(in_array($var, array_keys($vars))) {
                $this->$var = $arrayOfValues->$var;
                $columns[] = $var;
                $columnValues[] = $this->$var;
            }
        }
        
        $conn = getConnection();
        mysqli_query($conn, "INSERT INTO $this->tablename (" . implode(',', $columns) . ") VALUES ("  . implode(',', $columnValues) . ")");
        return $this;
    }
    // DELETE
    function delete($id) {
        
    }
    
    // Saves to DB
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
