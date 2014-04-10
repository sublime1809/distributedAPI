<?php
require_once 'objects/RestObject.php';
require('lib/twilio-php/Services/Twilio.php'); 

$account_sid = 'ACebfdd735cd36788c41c9a0e1e0a94d4d'; 
$auth_token = 'ad8b80003b388cf2d31aa50c3738800f'; 
$client = new Services_Twilio($account_sid, $auth_token); 

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
		
		$client->account->messages->create(array(
			'To' => $this->phone,
			'From' => "+13852357234",
			'Body' => "You have successfully signed the roll.",
		));

	}
}

