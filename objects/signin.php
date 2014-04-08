<?php
require_once 'objects/RestObject.php';

class signin extends RestObject { 
    public $classid;
    public $studentid;
    public $timestamp;
    
    function __construct() {
        parent::__construct('signins');
    }
    
    function create($arrayOfValues) {
        parent::create($arrayOfValues);
        // TODO generate text via Twillio
    }
}

