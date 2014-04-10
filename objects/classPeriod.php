<?php

class classPeriod extends RestObject {
    public $date;
    public $name;
    
    function __construct() {
        parent::__construct('classes');
    }
}

