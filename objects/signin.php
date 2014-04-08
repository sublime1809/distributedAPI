<?php
require_once 'objects/RestObject.php';

class signin extends RestObject { 
    public $class_id;
    public $student_id;
    public $name;
    public $phone;
    public $sign_time;
    
    function __construct() {
        parent::__construct('signins');
    }
    
    function create($arrayOfValues) {
        parent::create($arrayOfValues);
        // TODO generate text via Twillio
    }
}

