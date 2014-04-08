<?php
require_once 'objects/RestObject.php';

class signin extends RestObject { 
    private $classid;
    private $studentid;
    private $timestamp;
    
    function __construct($classid, $studentid, $timestamp) {
        $this->classid = $classid;
        $this->studentid = $studentid;
        $this->timestamp = $timestamp;
    }
    
    function getClass() {
        return $this->classid;
    }
    function getStudent() {
        return $this->studentid;
    }
    function getTimestamp() {
        return $this->timestamp;
    }
    
    function toString() {
        return $this->classid . ' - ' . $this->studentid . ' - ' . $this->timestamp;
    }
}

