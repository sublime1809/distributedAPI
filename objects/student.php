<?php

class student {
    public $name;
    public $student_id;
    public $phone;
    
    function __construct() {
        parent::__construct('students');
    }
}