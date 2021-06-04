<?php
require "../start.php";
use Src\Operations;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//var_dump(get_defined_vars());

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

if ($uri[4] !== 'ranking' and isset($uri[4])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

// check the method
//var_dump($_SERVER["REQUEST_METHOD"]);
$requestMethod = $_SERVER["REQUEST_METHOD"];

// pass the request method and process the HTTP request:
$controller = new Operations($dbConnection, $requestMethod);
$controller->processRequest();