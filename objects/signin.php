<?php
require_once 'objects/RestObject.php';
require('lib/twilio-php/Services/Twilio.php'); 

define('SID', 'ACebfdd735cd36788c41c9a0e1e0a94d4d');
define('AUTH_TOKEN', 'ad8b80003b388cf2d31aa50c3738800f');

class signin extends RestObject { 
	public $class_id;
	public $student_id;
	public $name;
	public $phone;
	public $sign_time;
        
        protected static $tablename = 'signins';
	
	function __construct() {
		parent::__construct('signins');
	}
	
	function create($arrayOfValues) {
		parent::create($arrayOfValues);
		
		$client = new Services_Twilio(SID, AUTH_TOKEN); 
		$client->account->messages->create(array(
			'To' => $this->phone,
			'From' => "+13852357234",
			'Body' => "You have successfully signed the roll.",
		));

	}
}

