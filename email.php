<?php
require 'lib/mailgun-php-1.7/vendor/autoload.php';
use Mailgun\Mailgun;

$class_id = $_POST['class_id'];

$roll = json_decode(file_get_contents("http://cs462.local/signin/class_id/".$class_id));

//var_dump($roll);

$message = "<h2>Roll:</h2><hr /><table><tr><th>netID</th><th>Name</th><th>Sign Time</th></tr>";

foreach ($roll as $student) {
	$message .= "<tr>"
		. "<td>$student->student_id</td>"
		. "<td>$student->name</td>"
		. "<td>$student->sign_time</td>"
		. "</tr>";
}
$message .= "</table>";

//var_dump($message);

// Instantiate the client.
$mg = new Mailgun('key-3l2x11ofeiqvyy1zs88073cxbtsmqxp2');
$domain = "sandbox03919bfa91e54f2f964446440ef8b3e9.mailgun.org";

// Now, compose and send your message.
$mg->sendMessage($domain, array('from'    => 'Mailgun Sandbox <postmaster@sandbox03919bfa91e54f2f964446440ef8b3e9.mailgun.org>',
                                'to'      => 'Leckie <leckster@gmail.com>', 
                                'subject' => 'Class Roll', 
                                'html'    => $message));

echo "success";