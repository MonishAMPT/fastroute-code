<?php

// Autoload Composer dependencies
require 'vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



// $test = new testing;
use FastRoute\RouteCollector;

// print_r($_SERVER);

$request_uri = $_SERVER['REQUEST_URI']; // Full URI including query string
$method = $_SERVER['REQUEST_METHOD']; // Request method (GET, POST, etc.)

$cleaned_uri = str_replace('/apitest', '', $request_uri);

$uri = parse_url($cleaned_uri, PHP_URL_PATH);

// var_dump($uri);
// var_dump($request_uri);
$dispatcher = FastRoute\simpleDispatcher(function(RouteCollector $r)  {
        // Load API routes
        $apiRoutes = require __DIR__ . '/routes/api.php';
        $apiRoutes($r);
    
        // Load web routes
        $webRoutes = require __DIR__ . '/routes/web.php';
        $webRoutes($r);

    

});
// Dispatch the current request
$routeInfo = $dispatcher->dispatch($method, $uri);

if (strpos($uri, '/api/') === 0) {
    header('Content-Type: application/json; charset=utf-8');
} else {
    header('Content-Type: text/html; charset=utf-8');
}

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // Route not found
        header("HTTP/1.1 404 Not Found");
        echo json_encode(["message" => "Route not found","method"=>$method,"uri"=>"$request_uri"]);
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        // Method not allowed
        header("HTTP/1.1 405 Method Not Allowed");
        echo json_encode(["message" => "Method not allowed"]);
        break;

    case FastRoute\Dispatcher::FOUND:
        // Route found, call the handler
        $handler = $routeInfo[1];
        $var = $routeInfo[2];
        call_user_func($handler,$var);
        break;
}

// Handlers for the routes


function helloworld(){
    echo json_encode(["hello"=>"HELLO WORLD! API IS WORKING LESGO!"]);
}
function test_get() {
    echo json_encode(["message" => "This is the test route (GET)"]);
}

function test_post() {
    $data = json_decode(file_get_contents('php://input'), true);
    echo json_encode(["message" => "POST request received", "data" => json_encode($data)]);
}

function items_get() {
    echo json_encode(["items" => ["item1", "item2", "item3"]]);
}

function items_post() {
    $data = json_decode(file_get_contents('php://input'), true);
    echo json_encode(["message" => "Item created", "item" => $data]);
}

function item_get_1() {
    echo json_encode(["item" => ["id" => 1, "name" => "Item 1"]]);
}


function getid($var){
    // var_dump($var);
    if (is_array($var)) {
        $id = $var['id'];
        $id2 = $var['id2'];
    }
    echo "given id: ".$id;
    echo "given id: ".$id2;

}


function delete($var){
    echo $var['id'];
}

function postdata($var){
    echo $var['test'];
    $data = json_decode(file_get_contents('php://input'), true);
    echo json_encode($data);
    
}
