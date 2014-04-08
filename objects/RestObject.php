<?php

class RestObject {
    
    private $id;
    
    function __construct() {
        
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
        
    }
    // DELETE
    static function delete($id) {
        
    }
    
    private function save() {
        
    }
}
