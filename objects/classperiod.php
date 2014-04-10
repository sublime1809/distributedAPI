<?php
require_once 'objects/RestObject.php';

class classperiod extends RestObject {
    public $date;
    public $name;
    protected static $tablename = 'classes';
    
    function __construct() {
        parent::__construct('classes');
    }
}

