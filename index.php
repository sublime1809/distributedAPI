<?php

ini_set('display_errors', true);
define('STDIN',fopen("php://input","r"));

$url = $_SERVER['PATH_INFO'];
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
            echo "Finding By: ";
            print_r($params);
            $obj = new $objName();
            echo $obj->findBy($params);
        } else {
            $id = $values[0];
            echo "Finding: " . $id;
            $obj = new $objName();
            echo $obj->find($id);
        }
        break;
    case 'POST' :
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
        echo 'updating... ' . $id;
        print_r($values);
        $obj = new $objName();
        echo json_encode($obj->update($id, $values));
        break;
    case 'DELETE':
        $id = $values[0];
        echo 'deleting ... ' . $id;
        $obj = new $objName();
        echo $obj->delete($id);
        break;
    default:
        echo 'nothing... ';
        break;
}
