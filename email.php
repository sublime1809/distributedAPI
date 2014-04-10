<?php
require 'lib/mailgun-php-1.7/vendor/autoload.php';
use Mailgun\Mailgun;

$class_id = $_POST['class_id'];
echo ($class_id);

$roll = file_get_contents("cs462.local/index.php/signin/class_id/1");

var_dump($roll);

echo "success";