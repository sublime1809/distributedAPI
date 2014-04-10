<?php

ini_set('display_errors', true);
define('STDIN',fopen("php://input","r"));

//$url = $_SERVER['REQUEST_URI'];
$url = $_GET['_url'];
$method = $_SERVER['REQUEST_METHOD'];

$params = explode('/', substr($url, 1));
$values = array_slice($params, 1);
$objName = strtolower($params[0]);

require_once('objects/'.$objName.'.php');

switch($method) {
    case 'GET' : 
        if(count($values)%2 == 0) {
            $params = array();
            for($i = 0; $i < count($values); $i=$i+2) {
                $params[$values[$i]] = $values[$i+1];
            }
            //echo "Finding By: ";
            //print_r($params);
            $obj = new $objName();
            returnSuccess($objName::findBy($params));
        } else {
            $id = $values[0];
            $obj = new $objName();
            returnSuccess($obj->find($id));
        }
        break;
    case 'POST' :
        if(count($_POST) > 0) {
            $values = json_decode($_POST['data']);
        } else {
            $values = json_decode(stream_get_contents(STDIN));
        }
        if(is_array($values)) {
            foreach($values as $value) {
                $obj = new $objName();
                returnSuccess($obj->create($value));
            }
        } else {
            $obj = new $objName();
            returnSuccess($obj->create($values));
        }
        break;
    case 'PUT' :
        $id = $values[0];
        $values = json_decode(stream_get_contents(STDIN));
        echo 'updating... ' . $id;
        print_r($values);
        $obj = new $objName();
        returnSuccess($obj->update($id, $values));
        break;
    case 'DELETE':
        $id = $values[0];
        echo 'deleting ... ' . $id;
        $obj = new $objName();
        returnSuccess($obj->delete($id));
        break;
    default:
        echo 'nothing... ';
        break;
}

function returnSuccess($object) {
    echo json_encode($object);
}
