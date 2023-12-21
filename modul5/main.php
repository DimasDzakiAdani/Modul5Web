<?php
header("Content-Type: application/json; charset=UTF-8");

include "Routes/MainRoutes.php";

use sip\Routes\MainRoutes;

$method = $_SERVER["REQUEST_METHOD"];

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);



$mainRoute = new MainRoutes();
$mainRoute->handle($method, $path);