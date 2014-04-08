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
        $obj = new $objName();
        echo $obj->find($id);
        break;
    case 'POST' :
        echo 'posting... ';
        $values = json_decode(stream_get_contents(STDIN));
        print_r($values);
        if(is_array($values)) {
            foreach($values as $value) {
                $obj = new $objName();
                echo $obj->create($value);
            }
        } else {
            echo $objName::getConnection();
            $obj = new $objName();
            echo $obj->create($values);
        }
        break;
    case 'PUT' :
        $id = $values[0];
        $values = json_decode(stream_get_contents(STDIN));
        echo 'putting... ';
        $obj = new $objName();
        echo $obj->update($id, $values);
        break;
    case 'DELETE':
        $id = $values[0];
        echo 'deleting ... ';
        $obj = new $objName();
        echo $obj->delete($id);
        break;
    default:
        echo 'nothing... ';
        break;
}
