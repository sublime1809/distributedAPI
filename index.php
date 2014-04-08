<?php

ini_set('display_errors', true);
define('STDIN',fopen("php://input","r"));

$url = $_GET['_url'];
$method = $_SERVER['REQUEST_METHOD'];

$params = explode('/', substr($url, 1));
var_dump($params);
$values = array_slice($params, 1);
$objName = strtolower($params[0]);

echo '<br />' . $method . ' -> ' . $objName . ' : ';
print_r($values);

require_once('objects/'.$objName.'.php');

echo '<br />';
switch($method) {
    case 'GET' : 
        $id = $values[0];
        echo 'getting... ';
        echo $objName::find($id);
        break;
    case 'POST' :
        echo 'posting... ';
        $values = json_decode(stream_get_contents(STDIN));
        print_r($values);
        echo $objName::create($values);
        break;
    case 'PUT' :
        $id = $values[0];
        $values = json_decode(stream_get_contents(STDIN));
        echo 'putting... ';
        break;
    case 'DELETE':
        $id = $values[0];
        echo 'deleting ... ';
        echo $objName::delete($id);
        break;
    default:
        echo 'nothing... ';
        break;
}
