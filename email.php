<?php
require 'lib/mailgun-php-1.7/vendor/autoload.php';
use Mailgun\Mailgun;

$class_id = $_POST['class_id'];
echo ($class_id);

$roll = json_decode(file_get_contents("http://cs462.local/signin/class_id/1"));
echo "got roll";
// Instantiate the client.
$mg = new Mailgun('key-3l2x11ofeiqvyy1zs88073cxbtsmqxp2');
echo "got mailer";
var_dump($mg);
$domain = "sandbox03919bfa91e54f2f964446440ef8b3e9.mailgun.org";

echo "here";

// Now, compose and send your message.
$mg->sendMessage($domain, array('from'    => 'Mailgun Sandbox <postmaster@sandbox03919bfa91e54f2f964446440ef8b3e9.mailgun.org>',
                                'to'      => 'Leckie <leckster@gmail.com>', 
                                'subject' => 'Class Roll', 
                                'text'    => $roll));

echo "success";